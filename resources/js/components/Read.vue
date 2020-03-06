<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Contact</h4>
          </div>
          <div class="col-md-2">
            <router-link class="btn btn-primary w-100" to="/create">+ Add Contact</router-link>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Phone</th>
              <th scope="col">Gender</th>
              <th scope="col">Address</th>
              <th scope="col">Action</th>              
            </tr>
          </thead>
          <tbody>
            <tr v-for="contact in contacts" :key="contact.id">
              <td style="width:25%">{{contact.name}}</td>
              <td style="width:15%">{{contact.phone}}</td>
              <td style="width:10%">{{contact.gender}}</td>
              <td style="width:30%">{{contact.address}}</td>
              <td style="width:20%">
                <router-link class="btn btn-warning" :to="'/detail/'+contact.id">Edit</router-link>
                <button class="btn btn-danger" v-on:click="deleteData(contact.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<!-- script js -->
<script>
export default {
  data() {
    return {
      contacts: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios.get("http://localhost:8000/api/contacts").then(response => {
        this.contacts = response.data;
      }, (error) => {
        console.log(error);
      });
    },
    deleteData(id) {
      axios.delete("http://localhost:8000/api/contact/delete-contact/" + id).then(response => {
        this.loadData();
      });
    }
  }
};
</script>
