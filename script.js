const plans = document.querySelectorAll('.plan');
const planValue = document.getElementById('plan-value');
const planPrice = document.getElementById('plan-price');
const profitGoal = document.getElementById('profit-goal');
const maxContracts = document.getElementById('max-contracts');
const dailyLoss = document.getElementById('daily-loss');
const drawdown = document.getElementById('drawdown');

plans.forEach(plan => {
  plan.addEventListener('click', () => {
    // Remove active class from all plans
    plans.forEach(p => p.classList.remove('active'));
    // Add active class to the clicked plan
    plan.classList.add('active');
    // Update details
    planValue.textContent = plan.dataset.value;
    planPrice.textContent = plan.dataset.price;
    profitGoal.textContent = plan.dataset.profit;
    maxContracts.textContent = plan.dataset.contracts;
    dailyLoss.textContent = plan.dataset.loss;
    drawdown.textContent = plan.dataset.drawdown;
  });
});

