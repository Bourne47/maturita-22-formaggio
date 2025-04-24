<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="card p-4 shadow w-100" style="max-width: 400px;">
    <h3 class="mb-4 text-center">Accedi</h3>
    <form action="./php/loginCheck.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" id="username" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="psw" class="form-label">Password:</label>
        <input type="password" id="psw" name="psw" class="form-control" required>
      </div>
      <div class="d-grid">
        <button type="submit" name="accedi" class="btn btn-success">Accedi</button>
      </div>
    </form>
  </div>
</div>
