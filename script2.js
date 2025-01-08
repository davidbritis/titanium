const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(item => {
  const question = item.querySelector('.faq-question');
  const icon = item.querySelector('.faq-icon');
  const answer = item.querySelector('.faq-answer');

  question.addEventListener('click', () => {
    item.classList.toggle('active');
    icon.classList.toggle('active'); // Alterna a classe "active" no ícone
    question.classList.toggle('active'); // Alterna a classe "active" na pergunta
  });
});


