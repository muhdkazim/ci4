<div class="card card-outline card-primary rounded-0">
    <div class="card-header">
        <h4 class="mb-0">Users</h4>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table id="userTable" class="table table-stripped table-bordered">
                <colgroup>
                    <col width="10%">
                    <col width="20%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient bg-primary text-light">
                        <th class="py-1 text-center">#</th>
                        <th class="py-1 text-center">First Name</th>
                        <th class="py-1 text-center">Last Name</th>
                        <th class="py-1 text-center">Middle Name</th>
                        <th class="py-1 text-center">Contact</th>
                        <th class="py-1 text-center">Email</th>
                        <th class="py-1 text-center">Action</th>
                    </tr>
                </thead>
                
            </table>
            
        </div>
    </div>
</div>
<!-- Script -->
<script type="text/javascript">
   $(document).ready(function(){

      $('#userTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url':"<?=site_url('main/getUsers')?>",
            'data': function(data){
               
               return {
                  data: data,
               };
            },
            dataSrc: function(data){
              // Datatable data
              return data.aaData;
            }
         },
         'columns': [
            { data: 'id' },
            { data: 'firstname' },
            { data: 'lastname' },
            { data: 'middlename' },
            { data: 'contact' },
            { data: 'email' },

            {
                        data: null,
                        render: function(data, type, row) {
                            return '<button onclick="edit(' + row.id + ')" class="btn btn-primary">Edit</button> ' +
                                '<button onclick="confirmDelete(' + row.id + ')" class="btn btn-danger">Delete</button>';
                        }
            }
         ]
      });
   });

   function edit(recordId)
   {
        window.location.href = "<?= site_url('main/edit/') ?>" + recordId;
   }

   function confirmDelete(recordId) {
        if (confirm("Are you sure you want to delete this record?")) {
            window.location.href = "<?= site_url('main/delete/') ?>" + recordId;
        }
    }
   </script>