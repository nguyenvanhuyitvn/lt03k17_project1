<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lỗi 404 - Trang không tìm thấy</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .error-container {
            text-align: center;
            background: white;
            padding: 60px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 90%;
        }

        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #667eea;
            line-height: 1;
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 32px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .error-description {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .error-icon {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .btn-group-error {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-error {
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-home:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            text-decoration: none;
        }

        .btn-back {
            background: #f0f0f0;
            color: #333;
            border: 2px solid #ddd;
        }

        .btn-back:hover {
            background: #e0e0e0;
            color: #333;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .back-image {
            opacity: 0.1;
            position: absolute;
            font-size: 300px;
            top: -50px;
            right: -50px;
            z-index: -1;
        }
    </style>

</head>

<body>
    <div class="error-container">
        <div class="back-image">403</div>

        <div class="error-icon">
            <svg class="glyph stroked warning" style="width: 80px; height: 80px;">
                <use xlink:href="#stroked-warning"></use>
            </svg>
        </div>

        <div class="error-code">403</div>

        <h1 class="error-title">Quyền truy cập bị từ chối!</h1>

        <p class="error-description">
            Xin lỗi, bạn không có quyền truy cập vào trang này.
            Vui lòng kiểm tra URL hoặc quay lại trang chủ.
        </p>

        <div class="btn-group-error">
            <button class="btn-error btn-home" onclick="window.location.href='index.php'">
                ← Quay lại Trang chủ
            </button>
            <button class="btn-error btn-back" onclick="javascript:history.back()">
                ← Quay lại trang trước
            </button>
        </div>
    </div>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>