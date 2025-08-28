function showTab(index) {
      const tabs = document.querySelectorAll('.tab-btn');
      const panels = document.querySelectorAll('.tab-panel');

      tabs.forEach((tab, i) => {
        tab.classList.toggle('active', i === index);
        panels[i].classList.toggle('show', i === index);
      });
    }