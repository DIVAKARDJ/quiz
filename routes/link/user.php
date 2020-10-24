<?php

Route::group(['middleware' => ['auth','web-user','lang'], 'namespace'=> 'User'], function() {
    Route::get('home', 'HomeController@userDashboardView')->name('userDashboardView');
    Route::get('category/{id}', 'CategoryController@categoryData')->name('categoryData');
    Route::get('category-info/{id}', 'CategoryController@categoryInfo')->name('categoryInfo');
    Route::post('unlock-category', 'CategoryController@categoryUnlock')->name('categoryUnlock');
    Route::get('buy-coin', 'CoinController@buyCoin')->name('buyCoin');
    Route::post('buy-coin-process', 'CoinController@buyCoinProcess')->name('buyCoinProcess');
    Route::post('buy-coin-by-razorpay', 'CoinController@buyCoinByRazorPay')->name('buyCoinByRazorPay');
    
    Route::post('buy-coin-by-payu', 'CoinController@buyCoinByPayU')->name('buyCoinByPayU');
    Route::post('indipay/response', 'CoinController@payuMoneyResponse')->name('indipay.response');
    
    Route::get('buy-coin-history', 'CoinController@buyCoinHistory')->name('buyCoinHistory');
    Route::get('leaderboard', 'HomeController@leaderBoard')->name('leaderBoards');
    Route::get('question-{index}-{id}', 'QuestionController@singleQuestion')->name('singleQuestion');
    Route::post('submit-user-answer', 'QuestionController@submitAnswer')->name('submitAnswer');
    Route::get('skip-coin-{index}-{id}', 'QuestionController@skipCoin')->name('skipCoin');
    Route::post('see-hints', 'QuestionController@seeHints')->name('seeHints');
    Route::post('fifty-option', 'QuestionController@fiftyOption')->name('fiftyOption');
    
    /***********************/
    Route::get('referral', 'ReferralController@referral')->name('referralSystem');
    Route::get('reward', 'RewardController@reward')->name('rewardSystem');
    Route::get('withdrawal', 'WithdrawalController@withdrawal')->name('withdrawalSystem');
    
    Route::post('withdrawal-process', 'WithdrawalController@withdrawalProcess')->name('withdrawalProcess');
    
    Route::post('pay-success', 'WithdrawalController@paySuccess')->name('pay-success');
  

});