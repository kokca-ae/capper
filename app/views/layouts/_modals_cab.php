<div class="modalsScroll">
        <div class="modals table">
            <div class="middle tCell">
                
            
				
				<div class="cabMod message blockMod init-modal" id="modal_type_2" style="display: none;">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="modContent darkBack" style="background-image: url(/assets/img/modal_back2.png)">
                            <span class="img" style="background-image: url(/assets/img/message_img2.png)"></span>
                            <span class="title"><?=$this->getLanguageText('Success');?></span>
                            <div class="text">
                                <span><?php if ($this->error) echo $this->error; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="cabMod message blockMod init-modal" id="modal_type_3">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="modContent darkBack" style="background-image: url(/assets/img/modal_back2.png)">
                            <span class="img" style="background-image: url(/assets/img/message_img.png)"></span>
                            <span class="title"><?=$this->getLanguageText('Error');?></span>
                            <div class="text">
                                <span><?php if ($this->error) echo $this->error; ?> <?php if ($this->walletErrName) echo $this->walletErrName; ?> </span>
                            </div>
                        </div>
                    </div>
                </div>
				
				
                <div class="cabMod deposit blockMod init-modal" id="deposit">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="modContent darkBack">
                            <span class="title"><?=$this->getLanguageText('Deposit');?> №<span id="d_id"></span></span>
                            <div class="depTable table full">
                                <div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-56"></span>
                                            <span class="text"><?=$this->getLanguageText('Status');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data">
                                        <span id="d_status"></span>
                                    </div>
                                </div>
                                <div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-27"></span>
                                            <span class="text"><?=$this->getLanguageText('Opened date');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data">
                                        <span id="d_date"></span>
                                    </div>
                                </div>
                                <div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-53"></span>
                                            <span class="text"><?=$this->getLanguageText('Currency');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data type1">
                                        <span id="d_curr"></span>
                                    </div>
                                </div>
                                <div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-20"></span>
                                            <span class="text"><?=$this->getLanguageText('Amount');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data type1 sum">
                                        <span id="d_amount"></span>
                                    </div>
                                </div>
								
								<div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-57"></span>
                                            <span class="text"><?=$this->getLanguageText('Accrued');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data type1 sum">
                                        <span id="d_accrued"></span>
                                    </div>
                                </div>
								
                                <div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-57"></span>
                                            <span class="text"><?=$this->getLanguageText('Charges');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data type2">
                                        <span id="d_accrual"></span>
                                    </div>
                                </div>
								
								<div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-57"></span>
                                            <span class="text"><?=$this->getLanguageText('Calculated');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data type1 sum">
                                        <span id="d_peraccrual"></span>
                                    </div>
                                </div>
								
								<div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-57"></span>
                                            <span class="text"><?=$this->getLanguageText('Total percentage');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data type2">
                                        <span id="d_percent"></span>
                                    </div>
                                </div>
                                <div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-27"></span>
                                            <span class="text"><?=$this->getLanguageText('Date of the next accrual');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data">
                                        <span id="d_dateupd"></span>
                                    </div>
                                </div>
								
                                <div class="tRow">
                                    <div class="tCell middle param">
                                        <div class="iconLeft">
                                            <span class="icon-55"></span>
                                            <span class="text"><?=$this->getLanguageText('Early withdrawal');?></span>
                                        </div>
                                    </div>
                                    <div class="tCell middle data">
                                        <span><?=$this->getLanguageText('Unavailable');?></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div id="overlay" style="display: none;"></div>
            </div>
        </div>
    </div>
	

	
<script>
$(function() {
	
	var typeReq = '<?=$this->typeReq;?>';
	if(typeReq>0){
		$('#overlay').css('display', 'block');
		$('#modal_type_'+typeReq).addClass('open');
		$('#modal_type_'+typeReq).css('display', 'block');
		$('.modalsScroll').addClass('open');
	}
	
});
</script>