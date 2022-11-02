
<!--<html>
   <head>
        <script src='https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js'></script>
   </head>
   <body>
        <script>
            Tesseract.recognize(
            'img.png',
            'eng',
            { logger: m => console.log(m) }
            ).then(({ data: { text } }) => {
                console.log(text);
            })
        </script>
   </body>
</html>-->




<html>
    <head>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/tesseract.js/1.0.4/tesseract.js'></script>
        <title>Tesseract Test</title>
    </head>
    <body>
        <label for="fileInput">Choose File for OCR:</label>
        <input type="file" id="fileInput" name="fileInput"/>
        <br />
        <br />
        <div id="document-content">
        </div>
    </body>
    <script>
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
    </script>
</html>
