<?php

test('health check returns 200', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
