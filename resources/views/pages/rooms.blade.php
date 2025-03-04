@extends('layouts.default')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('uploads/images/logo.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Ruangan <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Daftar Ruangan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light ftco-no-pt ftco-no-pb">
        <div class="container-fluid px-md-0">
            <div class="row no-gutters">
                @foreach ($data['rooms'] as $key => $room)
                    @php
                        $room_status = $room->status;
                        $borrower_status = [];

                        // Check if any borrow rooms
                        if ($room->borrow_rooms->isNotEmpty()) {
                            // Check each borrow_rooms
                            foreach ($room->borrow_rooms as $key => $borrow_room) {
                                // Show details if not finished yet by checking status first
                                if (
                                    $borrow_room->returned_at == null &&
                                    $borrow_room->admin_approval_status == App\Enums\ApprovalStatus::Disetujui
                                ) {
                                    $room_status = 1; // Set status room to Booked
                                    $borrower_first_name = ucfirst(
                                        strtolower(
                                            explode(
                                                ' ',
                                                Encore\Admin\Auth\Database\Administrator::find(
                                                    $borrow_room->borrower_id,
                                                )->name,
                                            )[0],
                                        ),
                                    );
                                    // $borrow_at =    Carbon\Carbon::make($borrow_room->borrow_at)->format('d M Y');
                                    // $until_at =     Carbon\Carbon::make($borrow_room->until_at)->format('d M Y');

                                    $borrow_at = Carbon\Carbon::parse($borrow_room->borrow_at);
                                    $until_at = Carbon\Carbon::parse($borrow_room->until_at);
                                    $count_days = $borrow_at->diffInDays($until_at) + 1;

                                    if ($count_days == 1) {
                                        $borrower_status[] = $borrower_first_name . ' - ' .
                                        $borrow_at->format('d M Y H:i:s') .
                                        ' s.d ' .
                                        $until_at->format('H:i:s');
                                    } else {
                                        $borrower_status[] =
                                            $borrower_first_name .
                                            ' - ' .
                                            $borrow_at->format('d M Y H:i:s') .
                                            ' s.d ' .
                                            $until_at->format('d M Y H:i:s');
                                    }
                                }
                            }
                        }
                    @endphp
                    <div class="col-lg-6">
                        <div class="room-wrap d-md-flex">
                            <div class="half left-arrow d-flex align-items-center">
                                <div class="text p-4 p-xl-5 text-center">
                                    <p class="mb-0">{{ $room->room_type->name }}</p>
                                    <h3 class="mb-3"><a href="rooms.html">{{ $room->name }}</a></h3>
                                    <ul class="list-accomodation">
                                        <li><span>Maks:</span> {{ $room->max_people }} Orang</li>
                                        <li><span>Status:</span> {{ App\Enums\RoomStatus::getDescription($room_status) }}
                                        </li>
                                        <li>
                                            @if (count($borrower_status) == 0)
                                                <br>
                                            @else
                                                {!! implode('<br>', $borrower_status) !!}
                                            @endif
                                        </li>
                                    </ul>
                                    <p class="pt-1"><a href="javascript:void(0)" id="buttonBorrowRoomModal"
                                            class="btn-custom px-3 py-2" data-toggle="modal" data-target="#borrowRoomModal"
                                            data-room-id="{{ $room->id }}" data-room-name="{{ $room->name }}">Pinjam
                                            Ruang Diskusi Ini <span class="icon-long-arrow-right"></span></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="borrowRoomModal" tabindex="-1" role="dialog" aria-labelledby="borrowRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="borrowRoomModalLabel">Pinjam Ruang Diskusi - Nama Ruang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('api.v1.borrow-room-with-college-student', []) }}"
                        class="appointment-form">
                        @csrf
                        <div class="row">
                            {{-- Hidden input for room_id --}}
                            <input id="room" name="room" type="hidden" value="{{ old('room') }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="full_name" type="text" class="form-control" placeholder="Nama Lengkap"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control" placeholder="Email Aktif"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="nim" type="text" class="form-control" placeholder="NIM" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <select name="need" id="" class="form-control" required>
                                                <option value="" selected disabled>Pilih Keperluan</option>
                                                <option value="diskusi" @if (old('need') == 'diskusi') selected @endif>
                                                    Diskusi</option>
                                                <option value="tugas-kelompok" @if (old('need') == 'tugas-kelompok') selected @endif>
                                                    Tugas Kelompok</option>
                                                <option value="belajar" @if (old('need') == 'belajar') selected @endif>
                                                    Belajar</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <select name="study_program" id="" class="form-control" required>
                                                <option value="" selected disabled>Pilih Prodi</option>
                                                @forelse ($data['prodi'] as $studyProgram)
                                                    <option value="{{ $studyProgram['code'] }}"
                                                        @if (old('study_program') == $studyProgram['code']) selected @endif>
                                                        {{ $studyProgram['name'] . ' (' . $studyProgram['degree'] . ')' }}
                                                    </option>
                                                @empty
                                                    <option value="" disabled>Belum ada prodi yang tersedia</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="ion-md-calendar"></span></div>
                                        <input id="borrow_at" name="borrow_at" value="{{ old('borrow_at') }}"
                                            type="text"
                                            class="form-control appointment_date-check-in datetimepicker-input"
                                            placeholder="Tgl Mulai" data-toggle="datetimepicker" data-target="#borrow_at"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="ion-md-calendar"></span></div>
                                        <input id="until_at" name="until_at" value="{{ old('until_at') }}" type="text"
                                            class="form-control appointment_date-check-out datetimepicker-input"
                                            placeholder="Tgl Selesai" data-toggle="datetimepicker" data-target="#until_at"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Pinjam Ruang Sekarang" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            //triggered when modal is about to be shown
            $(document).on('click', '#buttonBorrowRoomModal', function() {

                var roomName = $(this).data('room-name');
                var roomId = $(this).data('room-id');

                // Change value room
                $('input[name="room"]').val(roomId);

                // change title modal
                $('#borrowRoomModalLabel').text('Pinjam Ruang Diskusi - ' + roomName);

                // Rest form modal
                resetBorrowRoomModalForm()
            });

            function resetBorrowRoomModalForm() {
                $('#borrowRoomModal').find('input[name="full_name"]').val('');
                $('#borrowRoomModal').find('input[name="borrow_at"]').val('');
                $('#borrowRoomModal').find('input[name="until_at"]').val('');
                $('#borrowRoomModal').find('input[name="nim"]').val('');
                $('#borrowRoomModal').find('select[name="study_program"]').val($('select[name="study_program"] option:first')
                    .val());
            }
        </script>
    @endsection
@endsection
