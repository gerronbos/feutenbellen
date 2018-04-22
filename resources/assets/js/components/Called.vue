
<template>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Worden gebeld!</div>
  <!-- Table -->
  <table class="table">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Tel. nr</th>
            <th>Door wie</th>
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
                {{pledge.calledBy.calledBy}}
            </td>
            <td>
                <a v-bind:href="'/call/'+pledge.id+'?call_id='+pledge.calledBy.id" class="btn btn-default">Bekijken</a>
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
                 phone: '',
                 calledBy:''
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
             fetch("calls/calls")
             .then(res => res.json())
             .then(res => {
                 this.pledges = res.data
             })
         }
    }
 }
</script>