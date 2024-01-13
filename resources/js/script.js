let moduleData = document.getElementById("dataJS");
let labels = [];

if (moduleData.getAttribute("data-module") == "firstStepBook") {
    //const submitBtn = document.getElementById('firstStep')
    //const cDate = document.getElementById('bday')
    //const idService = document.getElementById("id_service");
    //const nameService = document.getElementById("name_service");
    
    /*cDate.addEventListener('change', (e) => {
      submitBtn.disabled = !(
          cDate.value !== ''
       );
    });*/

    //function handleClick(myRadio) {
    //    idService.value = myRadio.id;
    //    nameService.value = myRadio.dataset.name;
    //}

    function validateForm() {
        // Intenta obtener la referencia al div por su id
        var miDiv = document.getElementById("select-service");

        // Obtener todos los elementos de tipo radio
        var radios = document.querySelectorAll('input[type=radio]');
        
        // Verificar si al menos uno está marcado
        var anyCheck = Array.from(radios).some(radio => radio.checked);
        
        // Permitir o bloquear el envío del formulario
        if (anyCheck) {
            return true; // Se permite enviar el formulario
        } else {
            // Cambia la propiedad display a "block" para mostrar el div
            miDiv.style.display = "block";
            return false; // Bloquear el envío del formulario
        }
    }

    let infoJS = document.createElement('script');
    infoJS.type = 'text/javascript';
    infoJS.id = 'datePicker';
    infoJS.src = '../resources/js/datePicker.js';
    document.body.appendChild(infoJS);
} else {
    if (moduleData.getAttribute("data-module") == "secondStepBook") {
        $(document).ready(function() {
            $(".content-hours label").each(function() {
                $(this).on('click', {param: this.id}, selectBox);
            });
        });

        

        function selectBox(event) {
            event.preventDefault();
            let myBtn = document.getElementById('secondStep')
            let myLabel = document.getElementById(event.data.param);
            labels.push(myLabel);
            let myRadio = document.getElementById(event.data.param.substring(4));
            let myLabelCss = window.getComputedStyle(myLabel,null);
            let bgColor = myLabelCss.getPropertyValue("background-color");
            
            if (bgColor === "rgb(95, 158, 160)") {
                for (let i = 0; i < labels.length; i++) 
                    labels[i].style.backgroundColor = "rgb(95, 158, 160)";
                myLabel.style.backgroundColor = "rgb(255, 0, 0)";
                myBtn.disabled = false;
                myRadio.checked = true;
            }

            if (bgColor === "rgb(255, 0, 0)") {
                myLabel.style.backgroundColor = "rgb(95, 158, 160)";
                myRadio.checked = false;
            }
        }
    } else {
        if (moduleData.getAttribute("data-module") == "thirdStepBook") {
            const confirmBtn = document.getElementById("btnConfirm");

            function on_form_sbmt() {
                const full_name = document.getElementById("fullname");
                const phone_no = document.getElementById("phone");
                const phone_number = document.getElementById("phone_number");
                const email = document.getElementById("email");

                var textHint = document.getElementById("txtHint");
                
                if (full_name.value.length < 2 || !/^[A-Za-z\s]+$/.test(full_name.value)) { 
                    textHint.innerHTML = "<p style='color:red;font-size: 18px;'>Please Fill Your Name Properly</p>";
                    full_name.focus()
                    full_name.required=true;
                    return false;
                }else{
                    textHint.innerHTML = "";
                    full_name.required=false;
                    full_name.setCustomValidity("");
                }

                if (!validTel(phone_no.value)) { 
                    console.log("phone valid boto false");
                    textHint.innerHTML = "<p style='color:red;font-size: 18px;'>Fill in your phone number with 10 or 11 digits.</p>";
                    phone_no.focus()
                    phone_no.required=true;
                    return false;
                }else{
                    console.log("phone valid boto true ");
                    let pn = phone_no.value.replace(/[^0-9]/g, '');
                    let l = pn.length;
                    let tel = '', num = pn.substr(-7),
                    code = pn.substr(-10, 3),
                    coCode = '';
                    if(l>10) coCode = '+' + pn.substr(0, (l-10) );
                    tel = coCode +' ('+ code +') '+ num;
                    textHint.innerHTML = "";
                    phone_no.focus()
                    phone_no.value=tel.trim();
                    phone_no.required=false;
                    phone_no.setCustomValidity("");
                    phone_number.focus()
                    phone_number.value = (code + num).trim();
                }

                if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)) { 
                    textHint.innerHTML = "<p style='color:red;font-size: 18px;'>Please fill your email properly</p>";
                    email.focus()
                    email.required=true;
                    return false;
                }else{
                    textHint.innerHTML = "";
                    email.focus()
                    email.required=true;
                    email.setCustomValidity("");
                }
                
                confirmBtn.disabled = true;
                confirmBtn.value = "Please wait...";
                
                return true;

            }

            function validTel(str) {
                str = str.replace(/[^0-9]/g, '');
                var l = str.length;
                console.log("longitud del number: " + l);
                if(l<10 || l>11) return false;
                return true;
            }
        }
    }
}





