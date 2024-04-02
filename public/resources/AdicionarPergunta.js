
$(document).ready(function(){
        let contadorPerguntas = 0;
        $('#Adicionar_Pergunta').click(function(){
            contadorPerguntas++;
            let tipoPergunta = document.getElementById("tipo_pergunta").value;

            let descricaoPergunta = document.getElementById("Descri_Pergunta").value;
            
            let novaPergunta = '';
            if (tipoPergunta === '0') {
                novaPergunta = `
                    <div style='margin-top: 8px;' class='col-12'>
                        <x-adminlte-input name="pergunta${contadorPerguntas}" placeholder="${descricaoPergunta}"
                                        label="${contadorPerguntas}-${descricaoPergunta} " />
                    </div>
                `;
            } else if (tipoPergunta === '1') {
                let opcoes = '';
                
                let numOpcoes = parseInt(document.getElementById("Adicionar_campo").getAttribute("data-num-opcoes"));
                
                for (let i = 1; i <= numOpcoes; i++) {
                    let valorOpcao = document.getElementById(`alternativa${i}`).value;
                    
                    console.log(i);
                    opcoes += `<div><input type="checkbox" name="pergunta${contadorPerguntas}_opcao${i}" /><label> ${valorOpcao} </label></div>`;
                    console.log(opcoes);
                }
                novaPergunta = `
                    <div style='margin-top: 8px;' class='col-12'>
                        <label>${contadorPerguntas}-${descricaoPergunta}</label>
                        <div>
                            ${opcoes}
                        </div>
                    </div>
                `;
            }
            $("#perguntasContainer").append(novaPergunta);

        });
    });


