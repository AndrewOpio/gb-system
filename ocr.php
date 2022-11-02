<?php
    require 'vendor/autoload.php';
    use Google\Cloud\Vision\V1\ImageAnnotatorClient; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $client = new ImageAnnotatorClient([
            'credentials' => 'guinea-b-6a00d72ab73d.json'
        ]);

        try {
            $image_path = $_FILES['pic']['tmp_name'];
            $image = file_get_contents($image_path);
            $response = $client->textDetection($image);
            $text = $response->getTextAnnotations();

            echo $text[0]->getDescription();
            echo '<br/>';
            echo '<br/>';

            $client->close();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
?>


<html>
    <head>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/tesseract.js/1.0.4/tesseract.js'></script>
        <title></title>
    </head>
    <body>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <label for="fileInput">Choose File for OCR:</label>
            <input type="file" id="fileInput" name="pic" required/>
            <input type="submit" id="fileInput" name="pic" value="submit"/>
        </form>
        <br />
        <br />
        <div id="document-content">
        </div>
    </body>
    <!--<script>
        document.addEventListener('DOMContentLoaded', function(){
            var fileInput = document.getElementById('fileInput');
            fileInput.addEventListener('change', handleInputChange);
        });

        function handleInputChange(event){
            var input = event.target;
            var file = input.files[0];
                        
            console.log(file);
            Tesseract.recognize(file)
                .progress(function(message){
                    console.log(message);
                })
                .then(function(result) {
                    var contentArea = document.getElementById('document-content');
                    contentArea.innerHTML = result.text;
                })
                .catch(function(err){
                    console.error(err);
                });
        }
    </script>-->
</html>
