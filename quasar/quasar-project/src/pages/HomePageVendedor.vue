<template>
     <q-expansion-item
        expand-separator
        icon="perm_identity"
        label="Listar Pessoas por Papel e  lançar vendas"
    >
        <ListPessoaByPapel />
    </q-expansion-item>

    <q-expansion-item
        expand-separator
        icon="storefront"
        label="Dados de Vendas"
    >
        <ListAllVendas />
        <ListAllVendasByPessoa />
    </q-expansion-item>

</template>
<script>
import { defineComponent } from 'vue';
import ListPessoaByPapel from 'src/components/homepage/vendedor/lists/ListPessoaByPapel.vue';
import ListAllVendas from 'src/components/homepage/vendedor/lists/ListAllVendas.vue';
import ListAllVendasByPessoa from 'src/components/homepage/vendedor/lists/ListAllVendasByPessoa.vue';
export default defineComponent({
    data(){
        return {
            optionsPapel: [],
            papel: null
        }
    },

    components:{
        ListPessoaByPapel,
        ListAllVendas,
        ListAllVendasByPessoa
    }
});

</script>
