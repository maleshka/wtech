function registerUser(user) {
  const users = JSON.parse(localStorage.getItem('users')) || [];
  users.push(user);
  localStorage.setItem('users', JSON.stringify(users));
}

function loginUser(email, password) {
  const users = JSON.parse(localStorage.getItem('users')) || [];
  const user = users.find(u => u.email === email && u.password === password);
  if (user) {
    localStorage.setItem('loggedUser', JSON.stringify(user));
    return true;
  }
  return false;
}

function logoutUser() {
  localStorage.removeItem('loggedUser');
  localStorage.removeItem('cart_guest');
}

document.getElementById('registerForm')?.addEventListener('submit', e => {
  e.preventDefault();
  const inputs = e.target.querySelectorAll('input');
  const user = {
    firstName: inputs[0].value,
    lastName: inputs[1].value,
    email: inputs[2].value,
    password: inputs[3].value
  };
  registerUser(user);
  alert('Registration successful');
  window.location.href = 'login.html';
});

document.getElementById('loginForm')?.addEventListener('submit', e => {
  e.preventDefault();
  const email = e.target.querySelector('input[type="email"]').value;
  const password = e.target.querySelector('input[type="password"]').value;
  const success = loginUser(email, password);

  if (success) {
    alert('Login successful');
    window.location.href = 'home_page.html';
  } else {
    alert('Invalid credentials');
  }
});