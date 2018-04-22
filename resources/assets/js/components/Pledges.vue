<template>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Feuten</div>
  <div class="panel-body">
      <label for="status_id">Status</label>
      <select :value.sync="current_status" v-on:change="filter" name="status_id" id="status_id" class="form-control">
          <option value="0">Niets</option>
          <option value="1">Gaat zelf inschrijven</option>
          <option value="2">Ingeschreven</option>
          <option value="3">Kan/wil niet</option>
          <option value="4">Komt alleen naar eindfeest</option>
          <option value="5">Anders</option>
          <option value="6">Duplicaat - Staat er al in!</option>
          <option value="7">Annulering na inschrijving (OP TIJD)</option>
          <option value="8">Annulering na inschrijving (NIET OP TIJD - DOKKEN KUT!)</option>
      </select>
  </div>
  <!-- Table -->
  <table class="table">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Door wie</th>
            <th>Leeftijd</th>
            <th>Geslacht</th>
            <th>Tel. nr</th>
            <th>Woon addres</th>
            <th>Nood nummer</th>
            <th>Email</th>
            <th>Opleiding</th>
            <th>Shirt maat</th>
            <th>Status</th>
            <th>Opties</th>
        </tr>
        <tr v-for="pledge in pledges" v-bind:key="pledge.id">
            <td>
                {{pledge.name}}
            </td>
            <td>
                {{pledge.by.name}}
            </td>
            <td>
                {{pledge.age}}
            </td>
            <td>
                {{pledge.sex}}
            </td>
            <td>
                {{pledge.phone}}
            </td>
            <td>
                {{pledge.addres}}
            </td>
            <td>
                {{pledge.emergency_phone}}
            </td>
            <td>
                {{pledge.email}}
            </td>
            <td>
                {{pledge.education}}
            </td>
            <td>
                {{pledge.shirt_size}}
            </td>
            <td>
                {{pledge.status}}
            </td>
            <td>
                <a v-bind:href="'/call/'+pledge.id" class="btn btn-default">Bekijken</a>
            </td>
        </tr>
    </thead>
  </table>
  <nav>
  <ul class="pagination">
    <li v-bind:class="[{disabled: !pagination.prev_page_url}]"><a href="#" @click ="fetchPledges(pagination.prev_page_url)" aria-label="Previous">Vorige</a></li>
    <li class="disabled"><a href="#" class="text-dark">Pagina {{pagination.current_page}} / {{pagination.last_page}}</a></li>
    <li v-bind:class="[{disabled: !pagination.next_page_url}]"><a href="#" @click ="fetchPledges(pagination.next_page_url)">Volgende</a></li>
  </ul>
</nav>
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
                 by: '',
                 age: '',
                 sex: '',
                 phone: '',
                 addres: '',
                 emergency_phone: '',
                 email: '',
                 education: '',
                 shirt_size: '',
                 status: '',
                 phone: '',
             },
             current_status: 2,
             pagination: {}
         }
     },
     created() {
         this.fetchPledges();

         Echo.channel("updatePledge")
             .listen("UpdatePledgeEvent", (e) => {
                 if(e.pledge.status === this.current_status){
                     this.fetchPledges("/api/pledges?page_id="+this.pagination.current_page);
                 }
             })
     },
     methods: {
         fetchPledges(url) {
             if(url){
                 url = url+"&status_id="+this.current_status;
             }
             else{
                 url = "/api/pledges?status_id="+this.current_status;
             }
             
             var vm = this;
             fetch(url, {
                headers : { 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
             .then(res => res.json())
             .then(res => {
                 this.pledges = res.data
                 vm.makePagination(res.meta,res.links)
             })
             .catch(err => console.log(err))
         },
         filter(e){
             this.current_status = e.target.value;
             this.fetchPledges();
         },
         makePagination(meta,links) {
             var pagination = {
                 current_page : meta.current_page,
                 last_page : meta.last_page,
                 next_page_url : links.next,
                 prev_page_url : links.prev
             }

             this.pagination = pagination;
         }
    }
 }
</script>