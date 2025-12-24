@props(['usuario', 'tcc'])

<!--Lembrar de perguntar se eu posso enviar esse tcc via data-attributes, ou se da forma que está, ta beleza-->
<x-documentos.corpo position="start" titulo="Termo de Aceite do Orientador">

    Eu, Professor(a) <x-documentos.dados class="h-5 m-1">{{$usuario->name}}</x-documentos.dados>, do Curso de Ciência da
    Computação, do IFMG-Campus
    Formiga, aceito orientar o trabalho do(a) aluno(a) <x-documentos.dados class="h-5 m-1">{{$tcc->aluno->name}}
    </x-documentos.dados>. Declaro ter
    total
    conhecimento das normas de realização de trabalhos científicos, segundo o Regulamento de TCC vigente. Declaro
    ainda estar ciente do conteúdo do anteprojeto ora apresentado.





    <x-slot:assinatura>

        <x-documentos.assinatura>
            Assinatura do Orientador(a)
        </x-documentos.assinatura>


    </x-slot:assinatura>

</x-documentos.corpo>