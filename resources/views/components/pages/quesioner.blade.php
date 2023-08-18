@extends('layouts.app')

@section('title')
Pertanyaan Page
@endsection

@section('content')
@if (session('status'))
<script>
    Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: "{{ session('status') }}",
            });
</script>
@endif
<style>
    .questionnaire {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        /* width: 400px; */
    }

    .question {
        margin-bottom: 10px;
        font-weight: bold;
    }

    .answer-option {
        margin-bottom: 8px;
    }

    .answer-option label {
        display: block;
        margin-bottom: 5px;
    }

    .answer-option input[type="radio"] {
        margin-right: 5px;
    }

    .answer-option textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    .submit-button {
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        color: #fff;
        padding: 8px 16px;
        cursor: pointer;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }
</style>
<div class="page-content page-cart">
    <div class="container">
        <div class="questionnaire">
            <h1>Pertanyaan</h1>
            <form action="{{ route('post.Jawab.Pertanyaan') }}" method="POST">
                @csrf
                <div class="question">
                    <p>1. Bagaimana anda menilai kemudahan akses dan kegunaan website toko yayyshop dalam memesan
                        produk?
                    </p>
                    <div class="answer-option">
                        <label><input type="radio" name="q1" value="Sangat Baik"> Sangat Baik</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q1" value="Baik"> Baik</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q1" value="Buruk"> Buruk</label>
                    </div>
                </div>
                <div class="question">
                    <p>2. Seberapa baik layanan website toko yayyshop dalam membantu menampilkan informasi yang
                        diperlukan?</p>
                    <div class="answer-option">
                        <label><input type="radio" name="q2" value="Sangat Baik"> Sangat Baik</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q2" value="Baik"> Baik</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q2" value="Buruk"> Buruk</label>
                    </div>
                </div>
                <div class="question">
                    <p>3. Seberapa lengkap produk-produk yang ditawarkan oleh toko yayyshop?</p>
                    <div class="answer-option">
                        <label><input type="radio" name="q3" value="Sangat Lengkap"> Sangat Lengkap</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q3" value="Cukup Lengkap"> Cukup Lengkap</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q3" value="Tidak Lengkap"> Tidak Lengkap</label>
                    </div>
                </div>
                <div class="question">
                    <p>4. Seberapa menarik promo-promo yang sering dirilis oleh toko yayyshop?</p>
                    <div class="answer-option">
                        <label><input type="radio" name="q4" value="Sangat Menarik"> Sangat Menarik</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q4" value="Cukup Menarik"> Cukup Menarik</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q4" value="Tidak Menarik"> Tidak Menarik</label>
                    </div>
                </div>
                <div class="question">
                    <p>5. Apakah admin toko yayyshop cepat dan tanggap dalam melayani pemesanan dan chat para customer?
                    </p>
                    <div class="answer-option">
                        <label><input type="radio" name="q5" value="Sangat Setujuh"> Sangat Setujuh</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q5" value="Cukup Setujuh"> Cukup Setujuh</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q5" value="Tidak Setujuh"> Tidak Setujuh</label>
                    </div>
                </div>
                <div class="question">
                    <p>6. Seberapa memuaskan layanan kami dalam membantu menyelesaikan masalah anda?</p>
                    <div class="answer-option">
                        <label><input type="radio" name="q6" value="Sangat Memuaskan"> Sangat Memuaskan</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q6" value="Cukup Memuaskan"> Cukup Memuaskan</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q6" value="Tidak Memuaskan"> Tidak Memuaskan</label>
                    </div>
                </div>
                <div class="question">
                    <p>7. Apakah anda akan merekomendasikan toko yayyshop kepada oranglain?</p>
                    <div class="answer-option">
                        <label><input type="radio" name="q7" value="Sangat Merekomendasikan"> Sangat
                            Merekomendasikan</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q7" value="Ragu-Ragu"> Ragu-Ragu</label>
                    </div>
                    <div class="answer-option">
                        <label><input type="radio" name="q7" value="Tidak Merekomendasikan"> Tidak
                            Merekomendasikan</label>
                    </div>
                </div>
                <div class="question">
                    <p>8. Bagaimana kami dapat meningkatkan pengalaman anda? Silahkan berikan kritik dan saran anda.</p>
                    <div class="answer-option">
                        <label>
                            <textarea name="q8" id="" cols="2" rows="10"></textarea>
                        </label>
                    </div>
                </div>
                <button class="submit-button" type="submit">Kirim</button>
            </form>
        </div>
    </div>
</div>

@endsection