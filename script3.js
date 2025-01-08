// Alternar entre planos e atualizar detalhes
const planCards = document.querySelectorAll(".plan-card");
const detailValue = document.getElementById("detail-value");
const detailPrice = document.getElementById("detail-price");
const detailProfit = document.getElementById("detail-profit");
const detailContracts = document.getElementById("detail-contracts");
const detailLoss = document.getElementById("detail-loss");
const detailDrawdown = document.getElementById("detail-drawdown");

planCards.forEach(card => {
  card.addEventListener("click", () => {
    // Remove classe ativa de todos
    planCards.forEach(c => c.classList.remove("active"));
    // Adiciona classe ativa ao cartão atual
    card.classList.add("active");

    // Atualiza os valores com base nos atributos do cartão
    detailValue.textContent = card.dataset.value;
    detailPrice.textContent = card.dataset.price;
    detailProfit.textContent = card.dataset.profit;
    detailContracts.textContent = card.dataset.contracts;
    detailLoss.textContent = card.dataset.loss;
    detailDrawdown.textContent = card.dataset.drawdown;
  });
});

// Controle do carrossel
const container = document.querySelector(".plan-container");
const leftArrow = document.querySelector(".arrow.left");
const rightArrow = document.querySelector(".arrow.right");

let scrollAmount = 0;

leftArrow.addEventListener("click", () => {
  scrollAmount -= container.offsetWidth * 0.8;
  container.scrollTo({
    left: scrollAmount,
    behavior: "smooth"
  });
});

rightArrow.addEventListener("click", () => {
  scrollAmount += container.offsetWidth * 0.8;
  container.scrollTo({
    left: scrollAmount,
    behavior: "smooth"
  });
});
