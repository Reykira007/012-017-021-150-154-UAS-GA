package com.uas.atmaluhur;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    public void maps(View view) {
        Intent i = new Intent(MainActivity.this, Maps.class);
        startActivity(i);
    }

    public void lapor(View view) {
        Intent a = new Intent(MainActivity.this, Lapor.class);
        startActivity(a);
    }
}