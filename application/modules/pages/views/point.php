<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header">
            <h3 class="box-title"><?php echo lang('point_rules');?></h3>
        </div>
        <div class="box-body" style="font-size:17px;">
            <ul id="point_rules" class="list-group">
			<li class="list-group-item list-group-item-info"><h4> রেজিস্ট্রেশন করে আগে <a class="text-danger" href="<?php echo site_url_tr('routes/add');?>">রুট যোগ</a> এবং <a class="text-danger" href="<?php echo site_url_tr('transports/add');?>">পরিবহন যোগ</a> এই দুটি ফর্ম দেখে নিন তানাহলে নিচের নিয়মগুলি পরিষ্কার হবেনা</h4></li>
			  <li class="list-group-item">প্রতিটি রুট যোগের সময় সর্বোচ্চ ২টি ছবি দেয়া যাবে। একটি পরিবহনটির সামনের এবং আরেকটি যেকোন পাশের</li>
			  <li class="list-group-item">যদি পরিবহনের সামনে বা পাশে সব স্টপেজ/ভায়া লেখা থাকে এবং এমন ছবি দেন যেটা দেখে স্টপেজগুলির লেখা স্পষ্ট বোঝা যায় তাহলে প্রতি ছবির জন্য <span class="label label-info">৬</span> পয়েন্ট পাবেন</li>
			  <li class="list-group-item">স্টপেজ/ভায়া ইচ্ছেমত "স্টপেজ যোগ/Add Stoppage" বাটনে ক্লিক করে যোগ করতে পারবেন। প্রতিটি সঠিক স্টপেজের জন্য <span class="label label-info">২</span> পয়েন্ট</li>
			  <li class="list-group-item">প্রতিটি স্টপেজ যোগের সময় জায়গার নাম + ভাড়া এদুটি সঠিক হলেই পয়েন্ট, মন্তব্য আরেকটি ফিল্ড আছে ওটা ঐচ্ছিক।</li>
			  <li class="list-group-item">যদি ভাড়া সঠিক জানা না থাকে তাহলে মন্তব্য ফিল্ডে "ভাড়া নিশ্চিত না" এইটুকু লিখে দিলেও <span class="label label-info">১</span> পয়েন্ট পাবেন।</li>
			  <li class="list-group-item">যেকোন রুট অনুবাদ বা Translation করলে  <span class="label label-info">৬</span> পয়েন্ট পাবেন।</li>
			  <li class="list-group-item">যেকোন পরিবহন যোগ করলে (বাংলা নাম সহ) <span class="label label-info">৫</span> পয়েন্ট পাবেন। সাথে প্রতিটি কাউন্টার ঠিকানার জন্য সর্বোচ্চ <span class="label label-info">২</span> </li>
			  <li class="list-group-item">দুর পাল্লার পরিবহনে কাউন্টার ঠিকানা মোবাইল নাম্বার এবং যোগাযোগের ব্যাক্তি ইত্যাদি সহ যোগ করলে যতগুলি কাউন্টার তত  <span class="label label-info">২</span> পয়েন্ট পাবেন।</li>
			  <li class="list-group-item">দুর পাল্লার রুটে ছবি দিলে প্রতিটি ছবির জন্য <span  class="label label-info">৩</span> পয়েন্ট পাবেন। কারন দুর পাল্লার বাসে ভায়া/স্টপেজ সাধারনত লেখা থাকেনা</li>
			</ul>
        </div>
    </div>
</div>
<style>
#point_rules li span{
	font-size:20px;
}
#point_rules li a:hover{
	text-decoration:underline;
	font-weight:bolder;
}
</style>