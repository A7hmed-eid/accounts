<?php
session_start();
include 'db.php';

// تأكد أن المستخدم مسجل دخول وأنه admin أو manager
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'manager'])) {
    die("غير مسموح لك بعرض هذه الصفحة.");
}

// جلب جميع المستخدمين
$stmt = $conn->query("SELECT id, username, role FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>عرض المستخدمين</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background: #007BFF;
            color: white;
        }

        h2 {
            text-align: center;
        }

        a {
            display: inline-block;
            margin-bottom: 10px;
            text-decoration: none;
            color: white;
            background: #007BFF;
            padding: 8px 12px;
            border-radius: 5px;
        }

        a:hover {
            background: #0056b3;
        }

        .admin {
            font-weight: bold;
            color: green;
        }
    </style>
</head>

<body>
    <h2>قائمة المستخدمين</h2>
    <a href="index.html">العودة للصفحة الرئيسية</a>
    <table>
        <thead>
            <tr>
                <th>المستخدم</th>
                <th>الدور</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($u['username']) ?>
                    </td>
                    <td class="<?= $u['role'] == 'admin' ? 'admin' : '' ?>"><?= htmlspecialchars($u['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>