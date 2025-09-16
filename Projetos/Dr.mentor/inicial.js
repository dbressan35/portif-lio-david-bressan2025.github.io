
// Adiciona um "ouvinte" de evento para quando o usuário rolar a página (scroll)
window.addEventListener("scroll", function () {
  // Seleciona o elemento com o ID "header" (geralmente o cabeçalho da página)
  const header = document.getElementById("header");

  // Adiciona ou remove a classe "scrolled" dependendo da posição do scroll
  // Se a página foi rolada mais de 50px para baixo, adiciona a classe "scrolled"
  // Caso contrário, remove a classe
  header.classList.toggle("scrolled", window.scrollY > 50);
});

