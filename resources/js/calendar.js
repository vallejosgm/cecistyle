let moduleData = document.getElementById("bodyCal");
let labels = [];

if (moduleData.getAttribute("data-module") == "calendar") {
    
	let height = screen.height;
	elemToogleHeight = document.querySelector(".toogle-show").offsetHeight;
	elemHeaderCalHeight = document.querySelector(".headerCal").offsetHeight;
	elemNavHeight = document.querySelector(".nav").offsetHeight;
	elemFooterHeight = document.querySelector("footer").offsetHeight;
	document.getElementById("bodyCal").style.height =  ( height - elemToogleHeight - elemHeaderCalHeight - elemNavHeight - elemFooterHeight - ((0.00183611*height*height) - (3.6567655*height) + 1878.38189)) + "px";
    console.log('aqui toy');
            // Obtener el elemento del ancla
            var targetElement = document.querySelector("#day_selected");

            // Verificar si se encontró el elemento
            if (targetElement) {
                // Desplazarse al elemento
                targetElement.scrollIntoView({
                    behavior: 'smooth' // O 'auto' para un desplazamiento instantáneo
                });
            }
} else {
    if (moduleData.getAttribute("data-module") == "firstStepBook") {
        //const submitBtn = document.getElementById('firstStep')
        //const cDate = document.getElementById('bday')
        const idService = document.getElementById("id_service");
        const nameService = document.getElementById("name_service");
        
        /*cDate.addEventListener('change', (e) => {
          submitBtn.disabled = !(
              cDate.value !== ''
           );
        });*/

        function handleClick(myRadio) {
            idService.value = myRadio.id;
            nameService.value = myRadio.dataset.name;
        }

        

        let infoJS = document.createElement('script');
        infoJS.type = 'text/javascript';
        infoJS.id = 'datePicker';
        infoJS.src = 'js/datePicker.js';
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
                    //for (let i = 0; i < labels.length; i++) 
                    //        labels[i].style.backgroundColor = "rgb(95, 158, 160)";
                    myLabel.style.backgroundColor = "rgb(255, 0, 0)";
                    myBtn.disabled = false;
                    myRadio.checked = true;
                }

                if (bgColor === "rgb(255, 0, 0)") {
                    myLabel.style.backgroundColor = "rgb(95, 158, 160)";
                    myRadio.checked = false;
                }
            }
        }
    }
        
    }