/** 
 * LEA - Live Environment for Agents
 * by Renato Lenz Costalima
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
// modelo
function Agenda () {
    const contatos = [];
    this.listar = function () {
        return contatos;
    }
    this.cadastrar = function (contato) {
        contatos.push(contato);
    }
}
function AgendaCallback () {
    const contatos = [];
    this.listar = function (callback, reject) {
        if (contatos.length > 3) {
            reject(new Error('Não pode ser maior que 3.'));
        }
        callback(contatos);
    }
    this.cadastrar = function (contato) {
        contatos.push(contato);
    }
}
function AgendaPromessa () {
    const contatos = [];
    this.listar = function () {
        let promessa = new Promise(function (resolve, reject) {
            if (contatos.length > 3) {
                reject(new Error('Não pode ser maior que 3.'));
            }
            resolve(contatos);
        });
        return promessa;
    }
    this.cadastrar = function (contato) {
        let promessa = new Promise((resolve, reject) => {
            if (contato.nome == '') {
                reject(new Error('Nome não pode ser em branco!'));
            }
            contatos.push(contato);
            resolve();
        });
        return promessa;
    }
}
function AgendaServidor () {
    const url = '/admin/contatos/';
    this.listar = function () {
        let promessa = new Promise(function (resolve, reject) {
            fetch(url + 'listar.php').then(async r => {
                let contatos = await r.json();
                resolve(contatos);
            });
        });
        return promessa;
    }
    this.cadastrar = function (contato) {
        return fetch(url + 'cadastrar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(contato).toString()
        }).then(async r => {
            let ok = await r.json();
            console.log(ok);
        });
    }
}
// controlador
function ControladorAgenda() {
    const self = this;
    const agenda = new AgendaServidor();
    const menuView = new MenuTexto(this);
    const formView = new FormTexto(this);
    //const listaView = new ListaTexto(this);
    const listaView = new ListaGUI(this);
    this.menu = function () {
        menuView.menu();
    }
    this.formCadastrar = function () {
        formView.form();
    }
    this.cadastrar = function (contato) {
        agenda.cadastrar(contato).then(function () {
            self.listar();
        }).catch(function (erro) {
            console.error(erro);
        });
    }
    this.listar = function () {
        /*agenda.listar(function (contatos) {
            listaView.listar(contatos);
        }, function (erro) {
            
        });*/
        
        agenda.listar().then(function (contatos) {
            listaView.listar(contatos);
        }).catch(function (erro) {
            console.error(erro);
        });
    }
}
// visão
function FormTexto(controlador) {
    this.form = function () {
        let nome = prompt('Nome: ');
        let telefone = prompt('Telefone: ');
        let ano = prompt('Ano nascimento: ');
        let contato = {
            nome: nome,
            telefone: telefone,
            ano: ano
        };
        controlador.cadastrar(contato);
    }
}
function ListaTexto(controlador) {
    this.listar = function (contatos) {
        let lista = '';
        for (let contato of contatos) {
            lista += contato.nome + ': ' + contato.telefone + ' - ' + contato.ano + '\n';
        }
        alert(lista);
    }
}
function MenuTexto(controlador) {
    this.menu = function (agenda) {
        const menu = '1. Cadastrar\n2. Listar\n3. Procurar\n4. Sair';
        menu: while (true) {
            let opcao = parseInt(prompt(menu));
            switch (opcao) {
                case 1:
                    controlador.formCadastrar();
                    break;
                case 2:
                    controlador.listar();
                    break;
                case 3:
                    alert('procurar');
                    break;
                case 4:
                    alert('tchau');
                    break menu;
                default:
                    alert('Inválido!');
            }
        }
    }
}

function aoSubmeter(agenda, form) {
    let nome = form.nome.value;
    let telefone = form.telefone.value;
    let ano = form.ano.value;
    let contato = {
        nome: nome,
        telefone: telefone,
        ano: ano
    };
    agenda.cadastrar(contato);
}
function ListaGUI(controlador) {
    this.listar = function (contatos) {
        let tLista = document.querySelector('#lista');
        let tbody = tLista.querySelector('tbody');
        tbody.innerHTML = '';
        for (let contato of contatos) {
            let linha = document.createElement('tr');
            for (let p in contato) {
                let coluna = document.createElement('td');
                coluna.innerText = contato[p];
                linha.appendChild(coluna);
            }
            tbody.appendChild(linha);
        }
    }
}

let agenda = window.agenda;
if (!agenda) {
    agenda = new ControladorAgenda();
    window.agenda = agenda;
}
