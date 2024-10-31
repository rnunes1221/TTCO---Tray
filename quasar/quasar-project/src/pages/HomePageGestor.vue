<template>
    <CardCreatePessoa />
    <ListPessoaByPapel />

</template>
<script>
    import { defineComponent } from 'vue';
    import ListPessoaByPapel from 'src/components/homepage/gestor/lists/ListPessoaByPapel.vue';
    import CardCreatePessoa from 'src/components/homepage/gestor/cards/CardCreatePessoa.vue';
    export default defineComponent({
        data(){
            return {
                optionsPapel: [],
                papel: null
            }
        },

        components:{
            CardCreatePessoa,
            ListPessoaByPapel
        }
    });

</script>
