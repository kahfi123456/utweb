<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File untuk <?= esc($faculty) ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css') ?>">
</head>

<body>
    <div class="container">
        <!-- Logo Universitas Terbuka -->
        <img src="<?= base_url('images/ut_logo.png') ?>" alt="Logo Universitas Terbuka" class="logo">

        <!-- Welcome Text -->
        <div class="welcome-text">
            <h1>Selamat Datang Di File Manager Materi Pengayaan Universitas Terbuka</h1>
            <p>- Silahkan Memilih Materi Pengayaan berdasarkan fakultas atau gunakan Fitur Pencarian pada folder yang
                telah dipilih kemudian cari nama file bahan ajar untuk memudahkan pencarian Materi Pengayaan.</p>
            <h2>Cara Mendownload:</h2>
            <ul>
                <li>Silahkan Anda mendownload salah satu file dengan cara klik dua kali, untuk kemudian diarahkan ke
                    halaman preview agar dapat di download.</li>
            </ul>
        </div>
        <?php if (!empty($files)): ?>
            <?php foreach ($files as $index => $file): ?>
                <tr>
                     <!-- Form untuk membuat folder baru -->
        <form action="<?= site_url('filemanager/createFolder/' . $faculty); ?>" method="post">
            <input type="text" name="folder_name" placeholder="Nama Folder Baru" required>
            <button type="submit">Buat Folder</button>
        </form>

        
                <?php
                // Daftar folder dan file
                $folderPath = WRITEPATH . 'uploads/' . $faculty . '/';
                $folders = array_filter(glob($folderPath . '*'), 'is_dir'); // Ambil folder
                $fileIndex = 1;

                foreach ($folders as $folder) {
                    $folderName = basename($folder);
                    echo "<tr>
                            <td>$fileIndex</td>
                            <td><strong>$folderName</strong></td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <a href=\"" . site_url("filemanager/faculty/$faculty/$folderName") . "\">Buka Folder</a>
                            </td>
                          </tr>";
                    $fileIndex++;
                    
                    // Dapatkan file di dalam folder
                    $files = glob($folder . '/*');
                    foreach ($files as $file) {
                        $fileName = basename($file);
                        $fileSize = filesize($file);
                        $uploadDate = date("Y-m-d H:i:s", filemtime($file));
                        echo "<tr>
                                <td>$fileIndex</td>
                                <td>$fileName</td>
                                <td>" . round($fileSize / 1024, 2) . " KB</td>
                                <td>$uploadDate</td>
                                <td>
                                    <a href=\"" . site_url("filemanager/download/$fileName") . "\">Download</a>
                                </td>
                              </tr>";
                        $fileIndex++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Tidak ada file untuk fakultas ini.</td>
            </tr>
        <?php endif; ?>
    </div>
</body>

</html>