<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title float-left">Product List</h3>

            <div class="card-tools float-right">
              <button class="btn btn-success" @click="newModal">Add New</button>
            </div>
          </div>
          <!-- /.card-header -->

          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>ID</th>
                  <th>LP_ID</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Price_new</th>
                  <th>Slug</th>
                  <th>Modify</th>
                </tr>

                <tr v-for="product in products" :key="product.id">
                  <td>{{ product.id }}</td>
                  <td>{{ product.lp_product_id }}</td>
                  <td>{{ product.title }}</td>
                  <td>{{ product.price }}</td>
                  <td>{{ product.price_new }}</td>
                  <td>{{ product.slug }}</td>
                  <td>
                    <a href="#" @click="editModal(product)">Edit
                    </a>
                    /
                    <a href="#" @click="deleteProduct(product.id)">
                      Remove
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <form @submit.prevent="editMode ? updateProduct() : createProduct()">
      <div id="addNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addNewLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 v-show="!editMode" class="modal-title">Add New</h5>
              <h5 v-show="editMode" class="modal-title">Update Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Title</label>
                <input v-model="form.title" type="text" name="title" class="form-control" :class="{ 'is-invalid' : form.errors.has('title') }" placeholder="Title">
                <has-error :form="form" field="title" />
              </div>

              <div class="form-group">
                <label>Slug</label>
                <input v-model="form.slug" type="text" name="slug" class="form-control" :class="{ 'is-invalid' : form.errors.has('slug') }" placeholder="Slug">
                <has-error :form="form" field="slug" />
              </div>

              <div class="form-group">
                <label>LP-ID</label>
                <input v-model="form.lp_product_id" type="text" name="lp_product_id" class="form-control" :class="{ 'is-invalid' : form.errors.has('lp_product_id') }" placeholder="LP-ID">
                <has-error :form="form" field="lp_product_id" />
              </div>

              <div class="form-group">
                <label>Active</label>
                <input v-model="form.active" type="checkbox" value="1" name="active" :class="{ 'is-invalid' : form.errors.has('active') }" placeholder="Active">
                <has-error :form="form" field="active" />

                <label>Landing Page</label>
                <input v-model="form.landing_page" type="checkbox" value="1" name="landing_page" :class="{ 'is-invalid' : form.errors.has('landing_page') }" placeholder="Landing Page">
                <has-error :form="form" field="landing_page" />
              </div>

              <div class="form-group">
                <label>Image Landing</label>
                <input type="file" class="form-control" :class="{ 'is-invalid' : form.errors.has('image_landing') }" @change="getImage">
                <has-error :form="form" field="image_landing" />
              </div>

              <div class="form-group">
                <label>Price</label>
                <input v-model="form.price" type="text" name="price" class="form-control" :class="{ 'is-invalid' : form.errors.has('price') }" placeholder="Price">
                <has-error :form="form" field="price" />
              </div>

              <div class="form-group">
                <label>Price new</label>
                <input v-model="form.price_new" type="text" name="price_new" class="form-control" :class="{ 'is-invalid' : form.errors.has('price_new') }" placeholder="Price">
                <has-error :form="form" field="price_new" />
              </div>

              <div class="form-group">
                <label>Title UpSale</label>
                <input v-model="form.title_upsale" type="text" name="title_upsale" class="form-control" :class="{ 'is-invalid' : form.errors.has('title_upsale') }" placeholder="Title UpSale">
                <has-error :form="form" field="title_upsale" />
              </div>

              <div class="form-group">
                <label>Image UpSale</label>
                <input type="file" class="form-control" :class="{ 'is-invalid' : form.errors.has('image_upsale') }" @change="getImageUpSale">
                <has-error :form="form" field="image_upsale" />
              </div>

              <div class="form-group">
                <label>Price UpSale</label>
                <input v-model="form.price_upsale" type="text" name="price_upsale" class="form-control" :class="{ 'is-invalid' : form.errors.has('price_upsale') }" placeholder="Price UpSale">
                <has-error :form="form" field="price_upsale" />
              </div>

              <div class="form-group">
                <label>Price UpSale New</label>
                <input v-model="form.price_upsale_new" type="text" name="price_upsale_new" class="form-control" :class="{ 'is-invalid' : form.errors.has('price_upsale_new') }" placeholder="Price UpSale New">
                <has-error :form="form" field="price_upsale_new" />
              </div>

              <div class="form-group">
                <label>Lp Product Id UpSale</label>
                <input v-model="form.lp_product_id_upsale" type="text" name="lp_product_id_upsale" class="form-control" :class="{ 'is-invalid' : form.errors.has('lp_product_id_upsale') }" placeholder="Lp Product Id UpSale">
                <has-error :form="form" field="lp_product_id_upsale" />
              </div>

            </div>
            <div class="modal-footer">
              <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
              <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import HasError from 'vform/src/components/HasError'
import swal from 'sweetalert2'
import JQuery from 'jquery'
let $ = JQuery
export default {
  middleware: 'auth',
  components: {
    HasError
  },
  data () {
    return {
      editMode: false,
      products: {},
      activeTab: null,
      form: new Form({
        title: '',
        price: '',
        price_new: '',
        lp_product_id: '',
        image: '',
        images: '',
        image_landing: '',
        active: '',
        landing_page: '',
        slug: '',
        title_upsale: '',
        image_upsale: '',
        price_upsale: '',
        price_upsale_new: '',
        lp_product_id_upsale: ''
      })
    }
  },
  created () {
    this.loadProducts()
  },
  methods: {
    editModal (product) {
      this.editMode = true
      this.form.reset()
      $('#addNew').modal('show')
      this.form.fill(product)
    },
    newModal () {
      this.editMode = false
      this.form.reset()
      $('#addNew').modal('show')
    },
    deleteProduct (id) {
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          this.form.delete('/api/product/' + id).then(() => {
            swal(
              'Deleted!',
              'Your product has been deleted.',
              'success'
            )
          }).catch(() => {
            swal(
              'Failed!',
              'There was something wronge.',
              'warning'
            )
          })
        }
      })
    },
    loadProducts () {
      axios.get('/api/product').then(({ data }) => (this.products = data.data))
    },
    updateProduct () {

    },
    createProduct () {
      this.form.post('/api/product')
    },
    getImage (e) {
      let file = e.target.files[0]
      let reader = new FileReader()
      reader.onloadend = (file) => {
        this.form.image_landing = reader.result
      }
      reader.readAsDataURL(file)
    },
    getImageUpSale (e) {
      let file = e.target.files[0]
      let reader = new FileReader()
      reader.onloadend = (file) => {
        this.form.image_upsale = reader.result
      }
      reader.readAsDataURL(file)
    }
  }
}
</script>

<style scoped>

</style>
