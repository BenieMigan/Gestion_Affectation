<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Models\GetConnexion;

session_start();

// Vérifie que l'étudiant est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connexion DB
        $db = new GetConnexion('localhost', 'root', '', 'ma_base_test');
        $pdo = $db->getPDO();

        $id_etudiant = $_SESSION['user_id'];
        $message = !empty($_POST['message']) ? trim($_POST['message']) : null;

        // Rechercher la dernière soumission de l'étudiant
        $stmt = $pdo->prepare("SELECT id FROM soumissions WHERE id_etudiant = :id_etudiant ORDER BY created_at DESC LIMIT 1");
        $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $stmt->execute();
        $soumission = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($soumission) {
            $id_soumission = $soumission['id'];

            // Vérifie s’il y a déjà une relance en attente
            $check = $pdo->prepare("SELECT COUNT(*) FROM relances WHERE id_etudiant = :id_etudiant AND id_soumission = :id_soumission AND statut = 'en_attente'");
            $check->execute([
                ':id_etudiant' => $id_etudiant,
                ':id_soumission' => $id_soumission
            ]);
            $already = $check->fetchColumn();

            if ($already > 0) {
                $error = "Vous avez déjà une relance en attente.";
            } else {
                // Insère la nouvelle relance
                $insert = $pdo->prepare("INSERT INTO relances (id_etudiant, id_soumission, message) VALUES (:id_etudiant, :id_soumission, :message)");
                $insert->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
                $insert->bindParam(':id_soumission', $id_soumission, PDO::PARAM_INT);
                $insert->bindParam(':message', $message, PDO::PARAM_STR);
                $insert->execute();

                $success = "Votre demande de relance a été envoyée avec succès.";
            }

        } else {
            $error = "Aucune soumission trouvée pour votre profil.";
        }

    } catch (PDOException $e) {
        $error = "Erreur lors de l'envoi : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande de Relance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        secondary: {
                            600: '#7c3aed',
                            700: '#6d28d9',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center px-4 py-8">

    <div class="bg-white shadow-xl rounded-xl p-8 max-w-md w-full animate__animated animate__fadeIn">
        <div class="text-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Demande de Relance</h2>
            <p class="text-gray-500 mt-2 text-sm">
                Notifiez les responsables pour l'affectation d'un encadrant à votre projet
            </p>
        </div>

        <?php if ($success): ?>
            <div class="animate__animated animate__slideInDown bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium"><?= htmlspecialchars($success) ?></span>
                </div>
            </div>
        <?php elseif ($error): ?>
            <div class="animate__animated animate__slideInDown bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium"><?= htmlspecialchars($error) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div class="animate__animated animate__fadeIn animate__delay-1s">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message (optionnel)</label>
                <textarea 
                    name="message" 
                    id="message" 
                    rows="4" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition duration-200 placeholder-gray-400" 
                    placeholder="Ex: Je n'ai toujours pas d'encadrant attribué depuis 2 semaines..."
                ></textarea>
                <p class="mt-1 text-xs text-gray-500">Votre message sera envoyé aux responsables pédagogiques.</p>
            </div>

            <button 
                type="submit"
                class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold py-3 px-4 rounded-lg hover:from-primary-700 hover:to-primary-800 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50"
            >
                Envoyer la demande
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </form>

        <div class="mt-6 text-center animate__animated animate__fadeIn animate__delay-1s">
            <a href="infoetudiant.php" class="inline-flex items-center text-sm text-primary-600 hover:text-primary-800 transition duration-200 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour à l'espace étudiant
            </a>
        </div>
    </div>

</body>
</html>