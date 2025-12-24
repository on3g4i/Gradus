<x-documentos.corpo position="start" titulo="Termo de Defesa">

   Eu, Professor(a) <x-documentos.dados class="h-5 m-1">{{$usuario->name}}</x-documentos.dados> encaminho para Apresentação e Defesa
   Pública a monografia intitulada <strong><x-documentos.dados class="h-5 m-1">{{$tcc->nome_projeto}}</x-documentos.dados></strong>, 
   do aluno <x-documentos.dados class="h-5 m-1">{{$tcc->aluno->name}}</x-documentos.dados>, por considerar que ela 
   atende aos requisitos mínimos de uma monografia acadêmica e por considerar o(a) aluno(a) apto(a) a apresentá-la 
   perante a Banca Examinadora.
   
   <br/>
   Por ser verdade, firmo o presente.
   <x-slot:assinatura>

      <x-documentos.assinatura>
         Assinatura do Orientador(a)
      </x-documentos.assinatura>


   </x-slot:assinatura>

</x-documentos.corpo>



