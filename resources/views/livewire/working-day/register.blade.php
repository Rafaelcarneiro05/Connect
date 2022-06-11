<input type="date"> <br>
<input type="text" class="mask-hora" wire:model="hora"><br>
<input type="text" class="mask-dinheiro" wire:model="dinheiro">





<script type="text/javascript">        

    //máscara de dinheiro #valor_investido
    $(".mask-dinheiro").maskMoney({prefix: "R$ ", affixesStay: false, decimal:",", thousands:".", allowZero: true, allowNegative: false});
    $(".mask-hora").mask('99:99');
</script>

