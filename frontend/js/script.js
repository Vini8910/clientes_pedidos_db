function jpost(action, params = {}) {
    params.action = action;
    return $.post('backend/' + (action.includes('cliente') ? 'cliente.php' : 'pedido.php'), params);
}

function salvarCliente() {
    const nome = $('#nome').val();
    const cpf = $('#cpf').val();
    const email = $('#email').val();

    jpost('salvar_cliente', { nome, cpf, email }).done(() => {
        alert('Cliente salvo!');
        listarClientes();
    });
}

function listarClientes() {
    jpost('listar_clientes').done(res => {
        const dados = JSON.parse(res);
        $('#cliente_select').empty();
        dados.forEach(cli => {
            $('#cliente_select').append(`<option value="\${cli.ID}">\${cli.NOME}</option>`);
        });
    });
}

function salvarPedido() {
    const id_cliente = $('#cliente_select').val();
    const data = $('#data').val();
    const valor = $('#valor').val();
    const status = $('#status').val();

    jpost('salvar_pedido', { id_cliente, data, valor, status }).done(() => {
        alert('Pedido salvo!');
        listarPedidos();
    });
}

function listarPedidos() {
    const id_cliente = $('#cliente_select').val();
    jpost('listar_pedidos', { id_cliente }).done(res => {
        const pedidos = JSON.parse(res);
        let html = '<ul>';
        pedidos.forEach(p => {
            html += `<li>\${p.DATA_PEDIDO} - R$ \${p.VALOR_TOTAL} - \${p.STATUS}</li>`;
        });
        html += '</ul>';
        $('#lista_pedidos').html(html);
    });
}

$(document).ready(function() {
    listarClientes();
    $('#cliente_select').change(listarPedidos);
});