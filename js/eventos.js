$(document).ready(function () {
   
   function vazio(){
       let valueName = $("#cmpNomeBusca").prop('value').length
       let valueNumber = $("#cmpNumeroBusca").prop('value').length
       let valueData = $("#cmpDataBusca").prop('value').length

       return (valueName === 0) && (valueNumber === 0) && (valueData === 0)
   }
    
    
        
    $("#btn-search").click(() => {
        
        if(vazio() === true){
            $(".icon-search").toggleClass("icon-search-z-index")
            $(".container").toggleClass("open-search")
        }else{
            $("#btn-search").attr('type', 'submit')
        }
        
    });
            
});

function alterField(element){
           
    // Alimentando array com todos os filhos do select selecionado
    let listOptions = Object.entries(element)

    // Percorrendo todos os optins para verificar qual foi selecionado
    listOptions.map(
        (option) => {
            // Pegando o id do option selecionado
                var optionSelected = option[1].selected
                if(optionSelected){
                    var id = option[1].id

                    let cmpNumeroBusca = document.getElementById("cmpNumeroBusca")
                    let cmpDataBusca = document.getElementById("cmpDataBusca")
                    let cmpNomeBusca = document.getElementById("cmpNomeBusca")

                    if(id === 'optName'){
                        cmpNumeroBusca.disabled = true
                        cmpNumeroBusca.classList.remove("ativarCampo")
                        
                        cmpDataBusca.disabled = true
                        cmpDataBusca.classList.remove("ativarCampo")
                        
                        cmpNomeBusca.disabled = false
                        cmpNomeBusca.classList.add("ativarCampo")
                    }
                    
                    if(id === 'optNumeroCi'){
                        cmpNomeBusca.disabled = true
                        cmpNomeBusca.classList.remove("ativarCampo")
                        
                        cmpDataBusca.disabled = true
                        cmpDataBusca.classList.remove("ativarCampo")
                        
                        cmpNumeroBusca.disabled = false
                        cmpNumeroBusca.classList.add("ativarCampo")
                    }
                    
                    if(id === 'optData'){
                        cmpNomeBusca.disabled = true
                        cmpNomeBusca.classList.remove("ativarCampo")
                        
                        cmpNumeroBusca.disabled = true
                        cmpNumeroBusca.classList.remove("ativarCampo")
                        
                        cmpDataBusca.disabled = false
                        cmpDataBusca.classList.add("ativarCampo")
                    }
                    
                }
        }
    )
}