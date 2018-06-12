<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload de arquivo</title>
</head>
<body>

<?php
    if(isset($_POST['form'])):

        $extension_permitidas = array('jpg','jpeg','png');
        $extension            = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
      
            if(in_array($extension, $extension_permitidas)):
                $pasta    = 'arquivos';
                $filename = uniqid().'.'.$extension;

                if (!file_exists($pasta)):
                    mkdir($pasta, 0700);
                endif;  

                if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta.'/'.$filename)):
                    $mensagem = 'Arquivo salvo com sucesso!';
                else:
                    $mensagem = 'Arquivo não foi salvo, tente novamente mais tarde';
                endif;
            else:
                $mensagem = 'Tipo de arquivo não permitido';
            endif;    
    endif;
?>
<h1>Upload de arquivos</h1>

<?php if(!empty($mensagem)): ?>
    <p><?= $mensagem ?></p>
<?php endif; ?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="arquivo">
    <button type="submit" name="form"> Enviar </button>
</form>
    
</body>
</html>