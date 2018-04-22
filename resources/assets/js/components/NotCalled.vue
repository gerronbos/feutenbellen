<template>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Moeten nog gebeld worden!</div>
  <!-- Table -->
  <table class="table">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Tel. nr</th>
            <th>Opties</th>
        </tr>
        <tr v-for="pledge in pledges" v-bind:key="pledge.id">
            <td>
                {{pledge.name}}
            </td>
            <td>
                {{pledge.phone}}
            </td>
            <td>
                <a v-bind:href="'/call/'+pledge.id" class="btn btn-default show_pledge">Bekijken</a>
            </td>
        </tr>
    </thead>
  </table>
</div>
</template>

<script>
 export default{
     data() {
         return {
             pledges: [],
             pledge: {
                 id: '',
                 name: '',
                 phone: ''
             },
         }
     },
     created() {
         this.fetchPledges();

         Echo.channel("newCall")
             .listen("CreateCall", (e) => {
                 this.fetchPledges()
             })
     },
     methods: {
         fetchPledges() {
             fetch("calls/notcalls")
             .then(res => res.json())
             .then(res => {
                 this.pledges = res.data
             })
         }
    }
 }
</script>