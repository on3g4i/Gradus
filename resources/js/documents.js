import 'print-this';


const assinatura = document.getElementById('assinatura');
const signaturePad = new SignaturePad(assinatura);
let inputs = document.querySelectorAll('#documento input')


function verify(inputs) {
    let erros = Array();
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            erros.push(input);
        }
    });
    return erros;
}
(function ($) {
    //O usuário cria o documento quando clica no botão
    $('#criarDocumento').on('click', function () {
        let erros = verify(inputs);

        if (erros.length > 0 || signaturePad.isEmpty()) {
            erros.forEach(input => {
                input.focus();
            });
            Swal.fire({
                title: 'Preencha os dados do documento!',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        } else {
            $('#documento').printThis({
                afterPrint: () => {
                    //Pega a url e transforma em um array, cujo cada dado é uma parte dessa url
                    const pathParts = window.location.pathname.split('/');
                    const docId = pathParts[pathParts.length - 1];
                    //Fácil de pegar a variável de id do tcc, maaaas, n tem mto oq fazer
                    window.location.href = '/documentos/upload/' + docId;
                }
            });
        }

    });


    //Com dois cliques, a assinatura é limpa do canvas
    $('#assinatura').on('dblclick', () => {
        assinatura.getContext('2d').clearRect(0, 0, assinatura.width, assinatura.height);
    });

})(jQuery)
