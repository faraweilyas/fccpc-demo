@extends('layouts.backend.old.guest')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row mt-40">
                    <div class="col-md-6 mx-auto">
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img
                                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIxMTdweCIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMTE3IDExNyIgd2lkdGg9IjExN3B4IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZXNjLz48ZGVmcy8+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSI+PGcgZmlsbC1ydWxlPSJub256ZXJvIiBpZD0iY29ycmVjdCI+PHBhdGggZD0iTTM0LjUsNTUuMSBDMzIuOSw1My41IDMwLjMsNTMuNSAyOC43LDU1LjEgQzI3LjEsNTYuNyAyNy4xLDU5LjMgMjguNyw2MC45IEw0Ny42LDc5LjggQzQ4LjQsODAuNiA0OS40LDgxIDUwLjUsODEgQzUwLjYsODEgNTAuNiw4MSA1MC43LDgxIEM1MS44LDgwLjkgNTIuOSw4MC40IDUzLjcsNzkuNSBMMTAxLDIyLjggQzEwMi40LDIxLjEgMTAyLjIsMTguNSAxMDAuNSwxNyBDOTguOCwxNS42IDk2LjIsMTUuOCA5NC43LDE3LjUgTDUwLjIsNzAuOCBMMzQuNSw1NS4xIFoiIGZpbGw9IiMxN0FCMTMiIGlkPSJTaGFwZSIvPjxwYXRoIGQ9Ik04OS4xLDkuMyBDNjYuMSwtNS4xIDM2LjYsLTEuNyAxNy40LDE3LjUgQy01LjIsNDAuMSAtNS4yLDc3IDE3LjQsOTkuNiBDMjguNywxMTAuOSA0My42LDExNi42IDU4LjQsMTE2LjYgQzczLjIsMTE2LjYgODguMSwxMTAuOSA5OS40LDk5LjYgQzExOC43LDgwLjMgMTIyLDUwLjcgMTA3LjUsMjcuNyBDMTA2LjMsMjUuOCAxMDMuOCwyNS4yIDEwMS45LDI2LjQgQzEwMCwyNy42IDk5LjQsMzAuMSAxMDAuNiwzMiBDMTEzLjEsNTEuOCAxMTAuMiw3Ny4yIDkzLjYsOTMuOCBDNzQuMiwxMTMuMiA0Mi41LDExMy4yIDIzLjEsOTMuOCBDMy43LDc0LjQgMy43LDQyLjcgMjMuMSwyMy4zIEMzOS43LDYuOCA2NSwzLjkgODQuOCwxNi4yIEM4Ni43LDE3LjQgODkuMiwxNi44IDkwLjQsMTQuOSBDOTEuNiwxMyA5MSwxMC41IDg5LjEsOS4zIFoiIGZpbGw9IiM0QTRBNEEiIGlkPSJTaGFwZSIvPjwvZz48L2c+PC9zdmc+">
                                    </div>
                                </div>
                                <div class="row mt-6">
                                    <div class="col-md-12 text-center">
                                        <p>
                                            <strong>
                                                Your application <b>{{ $guest->getTrackingID() }}</b> has been submitted
                                                successfully.
                                            </strong>
                                        </p>
                                        <p>
                                            <strong>Our representative would get back to you.</strong>
                                        </p>
                                        <a
                                            href="{{ $guest->applicantPath() }}"
                                            class="btn btn-primary font-weight-bold text-uppercase mr-5 px-9 py-4"
                                        >
                                            Create a New Application
                                        </a>
                                        <a
                                            data-turbolinks="false"
                                            href="/"
                                            class="btn btn-secondary font-weight-bold text-uppercase mr-5 px-9 py-4"
                                        >
                                            Return Home
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
