function showLoading() {
  document.getElementById('loading').style.display = 'flex';
}

function login() {
  const username = document.getElementById('username').value.trim();
  const password = document.getElementById('password').value.trim();
  const errorDiv = document.getElementById('error');

  if ((username === "admin" && password === "admin123") || (username === "user" && password === "user123")) {
    showLoading(); // Mostrar a tela de carregamento

    let destino = username === "admin" ? "buscar_estudos.html" : "plataforma.html";

    setTimeout(() => {
      window.location.href = destino; // Após o delay, redireciona
    }, 2500); // 2.5 segundos de carregamento

  } else {
    errorDiv.textContent = "Usuário ou senha inválidos!";
  }
}