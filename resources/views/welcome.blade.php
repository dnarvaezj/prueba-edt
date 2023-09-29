<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <style>
    html,
    body,
    .intro {
      height: 100%;
    }

    table td,
    table th {
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow: hidden;
      margin-top: 30px;
    }

    .card {
      border-radius: .5rem;
    }

    .table-scroll {
      border-radius: .5rem;
    }

    thead {
      top: 0;
      position: sticky;
    }

    .fixed-col {
      right: 0;
      position: sticky;
      background-color: #393939;
    }

  </style>
</head>

<body class="antialiased">

  <div class="container p-4">
    <section>
    <p>
      <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Load CSV
      </button>
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#editModal"
        onclick="clearForm(`{{route('create_restaurant')}}`)"
      >
        New restaurant
      </button>
    </p>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <form action="{{route('load_csv')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="formFile" class="form-label">Select your CSV with restaurant data</label>
            <input name="csvFile" class="form-control" type="file" id="formFile">
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Load CSV file</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal create edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Create or edit restaurant</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
          </div>
          <form id="createForm" action="{{route('create_restaurant')}}" method="post">
            @csrf
            <div class="modal-body">
              <div class="row mb-3">
                <div class="col-md-3">
                  <label for="rating" class="form-label">Rating</label>
                  <input name="rating" type="number" class="form-control" id="rating" min="0" max="5">
                </div>
                <div class="col-md-3">
                  <label for="name" class="form-label">Name</label>
                  <input name="name" type="text" class="form-control" id="name">
                </div>
                <div class="col-md-3">
                  <label for="site" class="form-label">Site</label>
                  <input name="site" type="text" class="form-control" id="site">
                </div>
                <div class="col-md-3">
                  <label for="email" class="form-label">Email</label>
                  <input name="email" type="email" class="form-control" id="email">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input name="phone" type="tel" class="form-control" id="phone">
                </div>
                <div class="col-md-3">
                  <label for="street" class="form-label">Street</label>
                  <input name="street" type="text" class="form-control" id="street">
                </div>
                <div class="col-md-3">
                  <label for="city" class="form-label">City</label>
                  <input name="city" type="text" class="form-control" id="city">
                </div>
                <div class="col-md-3">
                  <label for="state" class="form-label">State</label>
                  <input name="state" type="text" class="form-control" id="state">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="lat" class="form-label">lat</label>
                  <input name="lat" type="text" class="form-control" id="lat">
                </div>
                <div class="col-md-6">
                  <label for="lng" class="form-label">lng</label>
                  <input name="lng" type="text" class="form-control" id="lng">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete restaurant</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
          </div>
          <form id="deleteForm" action="" method="post">
            @method('DELETE')
            @csrf
            <div class="modal-body">
              <input type="hidden" name="id">
              <h6 id="deleteText"></h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    </section>

    @if (isset($restaurantData) && count($restaurantData))
    <section class="intro">
      <div class="bg-image h-100" style="background-color: #f5f7fa;">
        <div class="mask d-flex align-items-center h-100">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card shadow-2-strong">
                  <div class="card-body p-0">
                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                      <table class="table table-dark mb-0">
                        <thead style="background-color: #393939;">
                          <tr class="text-uppercase text-success">
                            <th scope="col">rating</th>
                            <th scope="col">name</th>
                            <th scope="col">site</th>
                            <th scope="col">email</th>
                            <th scope="col">phone</th>
                            <th scope="col">street</th>
                            <th scope="col">city</th>
                            <th scope="col">state</th>
                            <th scope="col">lat | lng</th>
                            <th scope="col" class="fixed-col">options</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($restaurantData as $restaurant)
                          <tr>
                            <td>{{ $restaurant->rating}}</td>
                            <td>{{ $restaurant->name}}</td>
                            <td>{{ $restaurant->site}}</td>
                            <td>{{ $restaurant->email}}</td>
                            <td>{{ $restaurant->phone}}</td>
                            <td>{{ $restaurant->street}}</td>
                            <td>{{ $restaurant->city}}</td>
                            <td>{{ $restaurant->state}}</td>
                            <td>{{ $restaurant->lat }} | {{ $restaurant->lng }}</td>
                            <td class="fixed-col">
                              <button type="button" class="btn-secondary">
                                <i
                                  class="bi-pencil"
                                  onclick="edit('{{$restaurant}}', `{{route('edit_restaurant', $restaurant->id)}}`)"
                                  data-bs-toggle="modal"
                                  data-bs-target="#editModal"
                                ></i>
                              </button>
                              <button type="button" class="btn-danger">
                                <i
                                  class="bi-trash"
                                  onclick="remove('{{$restaurant}}', `{{route('delete_restaurant', $restaurant->id)}}`)"
                                  data-bs-toggle="modal"
                                  data-bs-target="#deleteModal"
                                ></i>
                              </button>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    @else
    <h1>There are no data</h1>
    @endif
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>

    let create = true;

    const edit = (data, actionForm) => {

      data = JSON.parse(data);
      let form = document.getElementById('createForm');
      form.action = actionForm;
      form.insertAdjacentHTML('afterbegin', `@method('PUT')`);
      document.getElementById('rating').value = data.rating;
      document.getElementById('name').value = data.name;
      document.getElementById('site').value = data.site;
      document.getElementById('email').value = data.email;
      document.getElementById('phone').value = data.phone;
      document.getElementById('street').value = data.street;
      document.getElementById('city').value = data.city;
      document.getElementById('state').value = data.state;
      document.getElementById('lat').value = data.lat;
      document.getElementById('lng').value = data.lng;

      create = false;

    };

    const clearForm = (actionForm) => {
      let form = document.getElementById('createForm');
      form.action = actionForm;
      form.reset();
      if (!create) form.removeChild(form.childNodes[0]);
      create = true;
    }

    const remove = (data, actionForm) => {
      data = JSON.parse(data);
      let form = document.getElementById('deleteForm');
      form.action = actionForm;
      document.getElementById('deleteText').innerHTML = `Are you sure to delete the restaurant <strong>${data.name}</strong>? This action cannot be undone.`;
    }

  </script>
</body>

</html>