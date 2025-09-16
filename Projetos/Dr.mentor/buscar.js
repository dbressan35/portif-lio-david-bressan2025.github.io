// Função para formatar datas do formato ISO (AAAA-MM-DD) para o formato brasileiro (DD/MM/AAAA)
function formatarData(dataISO) {
  const [ano, mes, dia] = dataISO.split("-"); // Divide a string pelo hífen
  return `${dia}/${mes}/${ano}`;              // Retorna no formato brasileiro
}

// Função para confirmar um agendamento específico pelo índice
function confirmarAgendamento(index) {
  let agendamentos = JSON.parse(localStorage.getItem("agendamentos") || "[]"); // Recupera os agendamentos do localStorage (ou um array vazio)
  agendamentos[index].confirmado = true;                                       // Marca o agendamento como confirmado
  localStorage.setItem("agendamentos", JSON.stringify(agendamentos));          // Atualiza o localStorage com a nova lista
  renderizarLista();                                                           // Atualiza a lista na tela
}

// Função para exibir a lista de agendamentos na página
function renderizarLista() {
  const lista = document.getElementById("lista");                              // Pega o elemento HTML onde a lista será exibida
  let agendamentos = JSON.parse(localStorage.getItem("agendamentos") || "[]"); // Recupera os agendamentos salvos

  if (agendamentos.length === 0) {
    lista.innerHTML = "<p>Nenhum agendamento realizado.</p>";                  // Caso não haja agendamentos → mensagem padrão
    return;                                                                    // Encerra a função
  }

  lista.innerHTML = "";                                                        // Limpa o conteúdo atual para recriar a lista do zero

  agendamentos.forEach((item, index) => {
    const statusHTML = item.confirmado
      ? `<span class="status">&#9989 Confirmado</span>`                        // Se confirmado, mostra o ícone ✅ e texto "Confirmado"
      : `<button onclick="confirmarAgendamento(${index})">Confirmar</button>`; // Se não, mostra um botão para confirmar

    lista.innerHTML += `
          <div class="agendamento" style="padding: 10px;">
            ${formatarData(item.data)}                                        
            ${statusHTML}                                                      
            <div style="clear: both;"></div>                                   
          </div>
        `;
  });
}

// Quando a página carrega, executa a função para exibir a lista na tela
window.onload = renderizarLista;
