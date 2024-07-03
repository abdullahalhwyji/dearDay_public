<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'show_data.php'; ?>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161772054-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-161772054-3');
    </script>

    <!-- Primary Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <title>Journal</title>
    <meta name="title" content="Simple Personal Journal / Personal Diary - Built purely with vanilla JS">
    <meta name="description" content="The simple journal app helps you add new entries and keep track of your previous entries. Using browser storage to store your content locally.">

    <link rel="stylesheet" href="../css/style_journal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
   
    <main class="main-container">
        <h1 class="title">My Journal</h1>
        <section class="input-section">
            <form id="entry-form" method="post" action="journalSaveData.php">
                <input type="text" name="entry_title" class="entry-title" placeholder="Give your entry a title..." required>
                <textarea name="entry_text" class="entry-textbox" placeholder="Start clearing out your head..." required></textarea>
                <button type="submit" class="primary-button">Submit</button>
            </form>
        </section>
        <section id="entries-section">
            <h2 class="entries-title">Entries <span class="date-updated">Last updated: <?= date('Y-m-d H:i:s'); ?></span></h2>
            <button class="dashboard-button" onclick="location.href='dashboard.php'">Go to Dashboard</button>
            <div class="entries-list">
                <?php if (!empty($entries)): ?>
                    <?php foreach ($entries as $entry): ?>
                        <div class="entry">
                            <h3><?= htmlspecialchars($entry['title']); ?></h3>
                            <p><?= nl2br(htmlspecialchars($entry['content'])); ?></p>
                            <small><?= htmlspecialchars($entry['timestamp']); ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No entries found.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer></footer>
</body>
</html>
