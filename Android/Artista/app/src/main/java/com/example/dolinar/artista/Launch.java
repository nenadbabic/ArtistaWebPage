package com.example.dolinar.artista;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;

public class Launch extends Activity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.launch_view);

        Thread t = new Thread() {
            public void run() {
                try {
                    sleep(1500);

                } catch (InterruptedException e) {
                    e.printStackTrace();
                } finally {
                    Intent mapAct = new Intent("android.intent.action.FRONT");
                    mapAct.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                    startActivity(mapAct);
                    finish();

                }
            }
        };
        t.start();

    }
}