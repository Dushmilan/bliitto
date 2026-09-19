Add-Type -AssemblyName System.Drawing
$img = new-object System.Drawing.Bitmap('c:\xampp\htdocs\bliittophp\uop-logo.png')
$white = [System.Drawing.Color]::FromArgb(255, 255, 255, 255)
$img.MakeTransparent($white)
$img.Save('c:\xampp\htdocs\bliittophp\uop-logo-transparent.png', [System.Drawing.Imaging.ImageFormat]::Png)
$img.Dispose()
