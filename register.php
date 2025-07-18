<?php
require_once 'config.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];

    // Basic validation
    if (empty($username)) $errors[] = "Username is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email already registered.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                $success = "Registration successful! <a href='login.php' class='text-light fw-bold'>Login here</a>.";
            } else {
                $errors[] = "Error: " . $conn->error;
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | MotionFlix</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --netflix-red: #e50914;
            --dark-bg: #141414;
            --muted-text: #bbb;
        }

        body {
            background-color: var(--dark-bg);
            color: white;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(229, 9, 20, 0.5);
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--netflix-red);
            text-align: center;
            margin-bottom: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-red {
            background-color: var(--netflix-red);
            color: white;
            font-weight: 600;
        }

        .btn-red:hover {
            background-color: #b0060f;
        }

        .form-control {
            background-color: #222;
            border: none;
            color: white;
        }

        .form-control:focus {
            border: 1px solid var(--netflix-red);
            background-color: #222;
            color: white;
            box-shadow: none;
        }

        a {
            color: var(--netflix-red);
        }

        a:hover {
            color: #ff3b3b;
        }

        .text-muted {
            color: var(--muted-text) !important;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <div class="brand-title">MotionFlix</div>
            <h4 class="mb-4 text-white text-center">Create Your Account</h4>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <form method="POST" action="register.php">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-red w-100">Sign Up</button>
            </form>

            <div class="mt-3 text-center">
                <p class="text-muted">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
