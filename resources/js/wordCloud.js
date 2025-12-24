(function () {
   function initCharts() {
      // Pegando dados do window lá do dashboard
      const dados = window.dashboardData?.palavra || {};
      const rawCounts = window.dashboardData?.meses || [];

      // --- Preparar dados do PIE (meses) ---
      const monthsPt = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
      const counts = Array.from({ length: 12 }, (_, i) => {
         const key = String(i + 1);
         const v = rawCounts[key] ?? rawCounts[i + 1] ?? 0;
         return Number(v ?? 0);
      });

      const monthPairs = monthsPt.map((m, idx) => ({ label: m, value: counts[idx] }))
         .filter(p => p.value > 0)
         .sort((a, b) => b.value - a.value);

      let pieLabels = [], pieData = [];
      if (monthPairs.length === 0) {
         pieLabels = ['Sem dados'];
         pieData = [1];
      } else {
         const top = monthPairs.slice(0, 12);
         pieLabels = top.map(p => p.label);
         pieData = top.map(p => p.value);
      }
      // Destrói pie chart existente, se houver
      const pieEl = document.getElementById('pie-chart');
      if (pieEl) {
         if (window._pieChart instanceof Chart) {
            window._pieChart.destroy();
         }
         window._pieChart = new Chart(pieEl, {
            type: 'doughnut',
            data: {
               labels: pieLabels,
               datasets: [{
                  data: pieData,
                  backgroundColor: [
                     '#6366F1', '#A78BFA', '#C7B8FF', '#9CA3AF', '#60A5FA', '#34D399'
                  ],
                  hoverOffset: 8,
                  cutout: '55%',
               }]
            },
            options: {
               responsive: true,
               maintainAspectRatio: false,
               plugins: {
                  legend: { position: 'hidden', labels: { usePointStyle: true, padding: 12, color: '#6B7280' } },
                  tooltip: {
                     callbacks: {
                        label: function (ctx) {
                           const v = ctx.parsed;
                           const total = ctx.dataset.data.reduce((s, x) => s + x, 0);
                           const pct = total ? ((v / total) * 100).toFixed(1) + '%' : '';
                           return ctx.label + ': ' + v + ' (' + pct + ')';
                        }
                     }
                  }
               }
            }
         });
      }

      // --- Preparar dados do BAR (palavras-chave) ---
      const labels = Object.keys(dados || {});
      const values = Object.values(dados || {});

      const barEl = document.getElementById('bar-chart');
      if (barEl) {
         if (window._barChart instanceof Chart) window._barChart.destroy();

         window._barChart = new Chart(barEl, {
            type: 'bar',
            data: {
               labels: labels,
               datasets: [{
                  label: 'Quantidade de TCCs',
                  data: values,
                  backgroundColor: '#4F46E5',
                  borderColor: '#4F46E5',
                  borderWidth: 1,
                  borderRadius: 6
               }]
            },
            options: {
               responsive: true,
               scales: {
                  y: { beginAtZero: true, ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } },
                  x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } }
               },
               plugins: { legend: { labels: { color: '#fff' } } }
            }
         });
      }
   }

   // Inicializa quando DOM estiver pronto
   if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initCharts);
   } else {
      initCharts();
   }

   // Opcional: expor função para re-render (útil se você atualizar dados via AJAX)
   window.dashboardInitCharts = initCharts;
})();