<article class="sponsor-wrap">
    <div class="sponsor-rolling-wrap js-sponsor-rolling inner-layer">
        <a href="https://astrazeneca.co.kr/product/?board_name=Product_Cat_A&order_by=fn_pid&order_type=desc&category1=%20%ED%98%B8%ED%9D%A1%EA%B8%B0&list_type=list&vid=13" target="_blank"><img src="/assets/image/main/img_sponsor_astra.gif" alt="아스트라제네카"></a>
		<a href="https://www.kolonpharm.co.kr/" target="_blank"><img src="/assets/image/main/img_sponsor_kolon.gif" alt="코오롱"></a>
		<a href="https://www.novartis.com/kr-ko/" target="_blank"><img src="/assets/image/main/img_sponsor_novartis.gif" alt="novartis"></a>
		<a href="https://www.hanmi.co.kr/main.hm" target="_blank"><img src="/assets/image/main/img_sponsor_hanmi.gif" alt="한미약품"></a>
		<a href="https://www.organon.com/korea/" target="_blank"><img src="/assets/image/main/img_sponsor_organon.png" alt="한국오가논"></a>
		<a href="https://www.yuhan.co.kr/Products/List/?mode=view&YPRD_IDX=2783&p=1&sm=-1&sf=YPRD_SORT&cid=176" target="_blank"><img src="/assets/image/main/img_sponsor_yuhan.gif" alt="유한양행"></a>
		<a href="https://www.sanofi.com/ko/south-korea" target="_blank"><img src="/assets/image/main/img_sponsor_sanofi.jpg" alt="sanofi"></a>
		<a href="/assets/file/벤토린 Risk Awareness Dialogue Aid for Healthcare Professionals (Final).pdf" target="_blank"><img src="/assets/image/main/img_sponsor_gsk.jpg" alt="gsk"></a>
		<a href="https://www.teva-handok.co.kr/" target="_blank"><img src="/assets/image/main/img_sponsor_handok.gif" alt="한독테바"></a>
		<a href="http://www.hyundaipharm.co.kr/" target="_blank"><img src="/assets/image/main/img_sponsor_hyundaipharm.jpg" alt="현대약품"></a>
		<a href="https://ekdp.com/main.do" target="_blank"><img src="/assets/image/main/img_sponsor_kwangdong.gif" alt="광동제약"></a>
        

        <!-- repeat -->
        <!-- <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_foster.png" alt="Foster"></a>
        <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_astra.png" alt="Astrazeneca"></a>
        <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_cinqair.png" alt="CINQAIR"></a>
        <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_monte.png" alt="몬테리진"></a>
        <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_novartis.png" alt="NOVARTIS"></a>
        <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_relvar.png" alt="RELVAR"></a> -->
    </div>
</article>
<footer id="footer">
    <button type="button" class="btn-top js-btn-top">
        <img src="/assets/image/common/ic_top.png" alt="">
        <span>TOP</span>
    </button>
    <div class="footer-wrap inner-layer">
        <ul class="footer-menu">
            <li><a href="{{ route('intro.regulation') }}">학회 정관</a></li>
            <li><a href="{{ route('privacy') }}">개인정보 취급방침</a></li>
            <li><a href="#pop-email" class="js-pop-open">이메일 무단 수집거부</a></li>
        </ul>
        <div class="footer-con">
            <ul>
                <li>
                    <strong>상호 : </strong> 대한천식알레르기학회
                </li>
                <li>
                    <strong>대표자 : </strong> 장안
                </li>
                <li>
                    <strong>사업자등록번호 : </strong> 208-82-05449
                </li>
                <li class="wide">
                    <p class="addr">{{ env('APP_ADDR') }}</p>
                </li>
                <li>
                    <strong>전화 : </strong> <a href="tel:{{ env('APP_TEL') }}" target="_blank">{{ env('APP_TEL') }}</a>
                </li>
                <li>
                    <strong>팩스 : </strong> {{ env('APP_FAX') }}
                </li>
                <li class="wide">
                    <strong>E-mail : </strong> <a href="mailto:{{ env('APP_EMAIL') }}" target="_blank">{{ env('APP_EMAIL') }}</a>, <a href="mailto:kaaaci@naver.com" target="_blank">kaaaci@naver.com</a>
                </li>
            </ul>
        </div>
    </div>

    <p class="copy text-center">
        Copyright 2020 THE KOREAN ACADEMY OF ASTHMA, ALLERGY AND CLINICAL IMMUNOLOGY. All Rights Reserved.
    </p>
</footer>
</div>

<!-- s:이메일 무단 수집 거부 popup -->
<div class="popup-wrap dim-click" id="pop-email" style="display: none;">
    <div class="popup-contents">
        <div class="popup-tit-wrap">
            <h4 class="popup-tit">
                <img src="/assets/image/common/ic_pop_email.png" alt=""> 이메일 무단 수집 거부
            </h4>
        </div>
        <div class="popup-conbox">
            <p class="text-center">
                대한천식알레르기학회는  정보통신망법 제50조의 2, 제50조의 7 등에 의거하여, 대한천식알레르기학회가 운영,관리하는 웹페이지상에서, 이메일 주소 수집 프로그램이나 그 밖의 기술적 장치 등을 이용하여 이메일 주소를 무단으로 수집하는 행위를 거부합니다. <br><br>

                <strong>[게시일 2020년 02월 01일]</strong>
            </p>
            <div class="btn-wrap text-center">
                <button type="button" class="btn btn-small js-pop-close">닫기 <span class="icon">▶</span></button>
            </div>
        </div>
    </div>
</div>
<!-- //e:이메일 무단 수집 거부 popup -->

</body>
</html>
