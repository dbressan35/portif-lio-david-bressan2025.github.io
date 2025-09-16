
// Define o número de horas já completadas do curso
const horasCompletadas = 15;

// Define o total de horas previstas para o curso
const horasTotais = 60;

// Obtém o contexto 2D do elemento <canvas> com id 'graficoCurso' para desenhar o gráfico
const ctx = document.getElementById('graficoCurso').getContext('2d');

// Cria uma nova instância de gráfico usando Chart.js
new Chart(ctx, {
  type: 'bar', // Define o tipo do gráfico ('bar' = gráfico de barras, pode ser trocado por 'line', etc.)
  data: {
    // Define os rótulos (legendas abaixo das barras)
    labels: ['Horas Completas', 'Horas Restantes'],
    datasets: [{
      label: 'Horas de Curso', // Nome da legenda (não aparece, pois legend: false abaixo)
      // Define os valores: horas completadas e horas restantes
      data: [horasCompletadas, horasTotais - horasCompletadas],
      // Define as cores das barras: verde para completas, cinza claro para restantes
      backgroundColor: ['#4caf50', '#e0e0e0']
    }]
  },
  options: {
    responsive: true, // Faz o gráfico se ajustar ao tamanho da tela
    plugins: {
      legend: { display: false }, // Oculta a legenda (já que temos os rótulos nas barras)
      tooltip: {
        // Personaliza o texto exibido ao passar o mouse sobre as barras
        callbacks: {
          label: function (context) {
            return `${context.parsed.y} horas`;
          }
        }
      },
      title: {
        display: true, // Exibe o título do gráfico
        // Título mostra as horas completadas e a porcentagem concluída
        text: `Você completou ${horasCompletadas} de ${horasTotais} horas (${((horasCompletadas / horasTotais) * 100).toFixed(1)}%)`
      }
    },
    scales: {
      y: {
        beginAtZero: true, // Começa o eixo Y no zero
        max: horasTotais,  // Define o máximo do eixo Y como o total de horas
        title: { display: true, text: 'Horas' } // Nome do eixo Y
      }
    }
  }
});


