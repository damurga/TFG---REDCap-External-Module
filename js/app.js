$( document ).ready(function() {

    // enable the submission button once a field_name is selected
    $( '#instrument' ).change(function() {
        $( '#submission' ).removeAttr('disabled');
    });

    $( '#guardar_plantilla' ).click(function() {

        var Text = document.getElementById("textarea").value

        let fieldName = prompt("Please enter a template name", "example");

        var blob = new Blob([Text], { type: "text/plain;charset=utf-8" });
        saveAs(blob, fieldName);

        //var selected = $('#instrument :selected').text()
        
        

    }); 

    $( '#repeatable' ).click(function() {

        var Text = document.getElementById("textarea_repeatable").value
        document.getElementById("textarea_repeatable").value = Text

        var TextWords = Text.split(/([" ",.:;\n])/g);

        var TextFinalWords = []

        for(var i=0; i<TextWords.length; i++){
            if(TextWords[i].startsWith("{")){
                var word = TextWords[i]

                if(word.charAt(word.length-2).match(/^[0-9]+$/)){
                    var num = parseInt(word.charAt(word.length-2))
                    num++;
                    var num2 = num.toString()

                    var word2=word.replace(word.charAt(word.length-2), num2)

                    TextFinalWords.push(word2)
                }

            }else{

                var word = TextWords[i]
                TextFinalWords.push(word)
            }
        }

        TextFinal = TextFinalWords.join("")
        
        document.getElementById("textarea_repeatable").value = TextFinal
    }); 


});


function loadFileAsText(){

    var fileToLoad = document.getElementById("fileToLoad").files[0];
    var Textarea = document.getElementById("textarea")


    let reader = new FileReader();

    reader.readAsText(fileToLoad);

    reader.onload = function() {
        Textarea.value = reader.result
      };
  
  }
  

function generateReport(){
    var fileToLoad = document.getElementById("fileToLoad2").files[0];

    let reader = new FileReader();

    reader.readAsText(fileToLoad);

    reader.onload = function() {
        TextTemplate = reader.result
        
        var words = TextTemplate.split(/([" ",.\n:;])/g);

        //var dataNames = document.getElementById("RecordFieldsNames").value
        //var RecordFieldsNames = dataNames.split(",")


        var RecordFieldsValuesSTR = document.getElementById("RecordFieldsValues").value
        var DictionarySTR = document.getElementById("ProjectDictionary").value

        var Dictionary = JSON.parse(DictionarySTR)
        var RecordFieldsValues = JSON.parse(RecordFieldsValuesSTR)

        var wordsRpl = []

        for(var i=0; i<words.length; i++){
            if(words[i].startsWith("{")){

                var word = words[i].replace(/[{}]/g, '').trim()
                
                var FieldOptions = ""
                var FieldOptionsCheck = ""
                var FieldOptionsYesNo = ""
                var FieldOptionsTrueFalse = ""

                //Primero miramos en el dict si el campo es de tipo options
                for(var pos=0; pos<Dictionary.length; pos++){
                    //Iteramos sobre el diccionario e iteramos sobre los campos
                    if(Dictionary[pos]['field_name'] == word){
                        if(Dictionary[pos]['field_type']=='dropdown' || Dictionary[pos]['field_type']=='radio'){
                            FieldOptions = Dictionary[pos]['select_choices_or_calculations']
                            
                        }else if(Dictionary[pos]['field_type']=='checkbox'){
                            FieldOptionsCheck = Dictionary[pos]['select_choices_or_calculations']

                        }else if(Dictionary[pos]['field_type']=='yesno'){
                            FieldOptionsYesNo = RecordFieldsValues[word]

                        }else if(Dictionary[pos]['field_type']=='truefalse'){
                            FieldOptionsTrueFalse= RecordFieldsValues[word]

                        }
                    }                    
                }

                var RecordValue = RecordFieldsValues[word]

                if(FieldOptions != ""){
                    var Options = FieldOptions.replaceAll(/[0-9],/g, '')
                    var RecordValuev2 = Options.split("|")
                    RecordValue = RecordValuev2[parseInt(RecordValue, 10)]

                }else if(FieldOptionsCheck != ""){
                    var Options = FieldOptionsCheck.replaceAll(/[0-9],/g, '')
                    var RecordValuev2 = Options.split("|")
                    var indexes = getAllIndexes(RecordValue, "1")
                    RecordValue = []

                    for(var e=0; e<indexes.length; e++){
                        RecordValue.push(RecordValuev2[indexes[e]])
                    }
                    
                    RecordValue = RecordValue.join(",")

                }else if(FieldOptionsYesNo != ""){
                    if(FieldOptionsYesNo == "1"){
                        RecordValue = "Yes"
                    }else{
                        RecordValue = "No"
                    }

                }else if(FieldOptionsTrueFalse != ""){
                    if(FieldOptionsTrueFalse == "1"){
                        RecordValue = "True"
                    }else{
                        RecordValue = "False"
                    }

                }else{
                    null
                }
                
                wordsRpl.push(RecordValue)

            }else{

                wordsRpl.push(words[i])

            }
        }
        var Textv2 = wordsRpl.join("")
        alert(Textv2)

        var TextFinal = Textv2.replace(/(?:\r\n|\r|\n)/g, '\\n');

        var inputReport = document.getElementById("Report")
        inputReport.value=TextFinal

        var SendReport = document.getElementById("EnviarReport")
        SendReport.click()
      };
}

function getAllIndexes(arr, val) {
    var indexes = []
    for(i = 0; i < arr.length; i++)
        if (arr[i] === val)
            indexes.push(i);
    return indexes;
}


