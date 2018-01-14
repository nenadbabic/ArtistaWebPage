package com.example.dolinar.artista;

import android.content.Context;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import java.io.IOException;

public class AddNew extends AppCompatActivity{
    public static final int PICK_IMAGE = 1;
    Context c;
    Bitmap bitmap;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.add_new_layout);
        c = this;
        Button addBtn = (Button) findViewById(R.id.btn_select_image);
        addBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent();
                intent.setType("image/*");
                intent.setAction(Intent.ACTION_GET_CONTENT);
                startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE);
            }
        });

        Button finishAdding = (Button) findViewById(R.id.btn_add_new_finish);
        finishAdding.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                EditText artTitleET = (EditText) findViewById(R.id.add_new_title);
                EditText artPriceET = (EditText) findViewById(R.id.add_new_price);
                EditText artDescriptionET = (EditText) findViewById(R.id.add_new_description);
                String artTitle = artTitleET.getText().toString();
                String artPrice = artPriceET.getText().toString();
                String artDescription = artDescriptionET.getText().toString();
                Toast.makeText(c, "Dodajanje koncano", Toast.LENGTH_LONG).show();
                finish();
            }
        });

    }
    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        ImageView imageView = (ImageView) findViewById(R.id.addPicture);
        if (requestCode == PICK_IMAGE && resultCode == RESULT_OK && null != data) {
            Uri uri = data.getData();
            try {
                bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), uri);
                imageView.setImageBitmap(bitmap);
            } catch (IOException e) {
                e.printStackTrace();
            }

        }
    }
}
