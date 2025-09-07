<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Setup - USNEWS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #004080;
            --secondary-blue: #1a75ff;
            --light-blue: rgba(0, 64, 128, 0.1);
            --success-green: #28a745;
            --danger-red: #dc3545;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .setup-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: #fff;
            text-align: center;
            padding: 30px 20px;
        }

        .card-header .logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .card-header .header-title {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .card-header .header-subtitle {
            font-size: 13px;
            opacity: 0.9;
        }

        .card-body {
            padding: 25px 20px;
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 64, 128, 0.15);
        }

        .password-requirements {
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            border: 1px solid var(--light-blue);
            margin-bottom: 15px;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 4px;
            color: #6c757d;
        }

        .requirement-item.valid {
            color: var(--success-green);
        }

        .requirement-item .icon {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #dee2e6;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .requirement-item.valid .icon {
            background: var(--success-green);
        }

        .security-tip {
            display: flex;
            gap: 8px;
            font-size: 12px;
            background: #d1ecf1;
            border: 1px solid #17a2b8;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            border: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            padding: 12px;
            width: 100%;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-primary:disabled {
            background: #6c757d;
            opacity: 0.6;
        }

        .card-footer {
            padding: 15px 20px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid var(--light-blue);
        }

        .alert-danger {
            font-size: 13px;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="setup-card">
        <div class="card-header">
            <div class="logo">USNEWS</div>
            <div class="header-title">Complete Your Setup</div>
            <div class="header-subtitle">Create a secure password to protect your account</div>
        </div>

        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('invitations.complete') }}" id="passwordForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-floating">
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="New Password" required>
                    <label for="password">🔒 New Password</label>
                </div>

                <div class="form-floating">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Confirm Password" required>
                    <label for="password_confirmation">🔒 Confirm Password</label>
                </div>

                <div class="password-requirements">
                    🛡️ Password Requirements
                    <div class="requirement-item" id="req-length"><span class="icon">✓</span> At least 8 characters
                    </div>
                    <div class="requirement-item" id="req-uppercase"><span class="icon">✓</span> Uppercase letter
                    </div>
                    <div class="requirement-item" id="req-lowercase"><span class="icon">✓</span> Lowercase letter
                    </div>
                    <div class="requirement-item" id="req-number"><span class="icon">✓</span> At least one number
                    </div>
                </div>

                <div class="security-tip">
                    💡
                    <div>Use a unique password and consider a password manager for extra security.</div>
                </div>

                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                    🚀 Complete Setup & Access Dashboard
                </button>
            </form>
        </div>

        <div class="card-footer">
            Already have an account? <a href="{{ route('login') }}">Sign in here</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');

            const requirements = {
                length: document.getElementById('req-length'),
                uppercase: document.getElementById('req-uppercase'),
                lowercase: document.getElementById('req-lowercase'),
                number: document.getElementById('req-number')
            };

            function validatePassword() {
                const password = passwordInput.value;
                const confirmPassword = confirmInput.value;

                const checks = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password)
                };

                Object.keys(checks).forEach(req => {
                    if (checks[req]) requirements[req].classList.add('valid');
                    else requirements[req].classList.remove('valid');
                });

                const allValid = Object.values(checks).every(check => check);
                const passwordsMatch = password === confirmPassword && password.length > 0;

                submitBtn.disabled = !(allValid && passwordsMatch);

                if (confirmPassword.length > 0) {
                    if (passwordsMatch) {
                        confirmInput.style.borderColor = '#28a745';
                    } else {
                        confirmInput.style.borderColor = '#dc3545';
                    }
                } else {
                    confirmInput.style.borderColor = '#ced4da';
                }
            }

            passwordInput.addEventListener('input', validatePassword);
            confirmInput.addEventListener('input', validatePassword);
            validatePassword();
        });
    </script>
</body>

</html>
