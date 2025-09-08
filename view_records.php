<?php
session_start();
include 'db.php';

// تأكد أن المستخدم مسجل دخول
if (!isset($_SESSION['user'])) {
    die("يجب تسجيل الدخول لعرض البيانات.");
}

// جلب الحسابات اليومية
$stmt = $conn->query("SELECT * FROM records ORDER BY empDate DESC");
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>عرض الحسابات اليومية</title>
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
    </style>
</head>

<body>
    <h2>الحسابات اليومية</h2>
    <a href="index.html">العودة للصفحة الرئيسية</a>
    <table>
        <thead>
            <tr>
                <th>اسم الموظف</th>
                <th>التاريخ</th>
                <th>التليفون</th>
                <th>القيمة</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $r): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($r['empName']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($r['empDate']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($r['empPhone']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($r['empValue']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>