<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        margin-top: 20px;
        background-color: #f1f3f7;
      }

      .container{
        width: 85%;
      }
      .avatar-lg {
        height: 5rem;
        width: 5rem;
      }

      .font-size-18 {
        font-size: 18px !important;
      }

      .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      a {
        text-decoration: none !important;
      }

      .w-xl {
        min-width: 160px;
      }

      .card {
        margin-bottom: 24px;
        -webkit-box-shadow: 0 2px 3px #e4e8f0;
        box-shadow: 0 2px 3px #e4e8f0;
      }

      .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #eff0f2;
        border-radius: 1rem;
      }

      /* Modal styles */
      .success-modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        z-index: 1000;
      }

      .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 999;
      }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row my-4">
          <div class="col-sm-6">
            <a href="{{ route('shop.index') }}" class="btn btn-link text-muted">
                <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping 
            </a>
        </div>        
        </div>
        {{-- {{dump($data)}} --}}
        @if (count($data) > 0)
          <div class="row">
              <div class="col-xl-8">
                  @php
                      $totalPrice = 0;
                  @endphp
                  @foreach ($data as $item)
                      @php
                          $itemTotal = $item->qty * $item->price;
                          $totalPrice += $itemTotal;
                      @endphp
                      <div class="card border shadow-none">
                          <div class="card-body">
                              <div class="d-flex align-items-start border-bottom pb-3">
                                  <div class="me-4">
                                      <img src="{{ asset('images/' . $item->product_image) }}" alt class="avatar-lg rounded">
                                  </div>
                                  <div class="flex-grow-1 align-self-center overflow-hidden">
                                      <div>
                                          <h5 class="text-truncate font-size-18">
                                              <a href="#" class="text-dark">{{ $item->name }}</a>
                                          </h5>
                                          <p class="text-muted mb-0">
                                              <i class="bx bxs-star text-warning"></i>
                                              <i class="bx bxs-star text-warning"></i>
                                              <i class="bx bxs-star text-warning"></i>
                                              <i class="bx bxs-star text-warning"></i>
                                              <i class="bx bxs-star-half text-warning"></i>
                                          </p>
                                          <p class="mb-0 mt-1">{{ $item->description }}</p>
                                      </div>
                                  </div>
                                  <div class="flex-shrink-0 ms-2">
                                      <ul class="list-inline mb-0 font-size-16">
                                          <li class="list-inline-item">
                                              <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-link text-muted px-1">
                                                      <i class="mdi mdi-trash-can-outline"></i>
                                                  </button>
                                              </form>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                              <div>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="mt-3">
                                              <p class="text-muted mb-2">Price</p>
                                              <h5 class="mb-0 mt-2">Rs {{ $item->price }}</h5>
                                          </div>
                                      </div>
                                      <div class="col-md-5">
                                          <div class="mt-3">
                                              <p class="text-muted mb-2">Quantity</p>
                                              <div class="d-inline-flex">
                                                  <span>{{ $item->qty }}</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="mt-3">
                                              <p class="text-muted mb-2">Total</p>
                                              <h5>Rs {{ $itemTotal }}</h5>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
              <div class="col-xl-4">
                  <div class="mt-5 mt-lg-0">
                      <div class="card border shadow-none">
                          <div class="card-header bg-transparent border-bottom py-3 px-4">
                              <h5 class="font-size-16 mb-0">Order Summary <span class="float-end">#MN0124</span></h5>
                          </div>
                          <div class="card-body p-4 pt-2">
                              <div class="table-responsive">
                                  <table class="table mb-0">
                                      <tbody>
                                          <tr>
                                              <td>Sub Total :</td>
                                              <td class="text-end">Rs {{ $totalPrice }}</td>
                                          </tr>
                                          <tr>
                                              <td>Shipping Charge :</td>
                                              <td class="text-end">Rs 150</td>
                                          </tr>
                                          <tr class="bg-light">
                                              <th>Total :</th>
                                              <td class="text-end"><span class="fw-bold"> Rs {{ $totalPrice + 150 }} </span></td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="row my-4">
                              <div class="col-12">
                                  <div class="text-center">
                                      <button onclick="saveOrder()" class="btn btn-success mx-2">
                                          <i class="mdi mdi-cash-multiple me-1"></i> Pay Now
                                      </button>
                                      <a href="{{ route('cart.checkout') }}" class="btn btn-success mx-2">
                                          <i class="mdi mdi-cart-outline me-1"></i> Pay with PayPal
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        No product found
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Success Modal -->
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="success-modal" id="successModal">
        <h4>Success!</h4>
        <p>Your order has been placed successfully.</p>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function saveOrder() {
            // Send request to save order without payment
            fetch('{{ route("cart.save-order") }}', {
                method: 'POST', // Changed to POST since route is POST
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                showSuccessModal();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving order. Please try again.');
            });
        }

        function showSuccessModal() {
            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('successModal').style.display = 'block';
            
            // Redirect after 2 seconds
            setTimeout(() => {
                window.location.href = '{{ route('shop.index') }}';
            }, 2000);
        }
    </script>
  </body>
</html>